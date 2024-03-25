<?php
/* Note: No credit is provided for submitting design and/or code that is     */
/*       taken from course-provided examples.                                */
/*                                                                           */
/* Do not copy this code into your project submission and then change it.    */
/*                                                                           */
/* Write your own code from scratch. Use this example as a REFERENCE only.   */
/*                                                                           */
/* You may not copy this code, change a few names/variables, and then claim  */
/* it as your own.                                                           */
/*                                                                           */
/* Examples are provided to help you learn. Copying the example and then     */
/* changing it a bit, does not help you learn the learning objectives of     */
/* this assignment. You need to write your own code from scratch to help you */
/* learn.                                                                    */

$page_title = "Transcript";

$nav_transcript_class = "active_page";

include_once("includes/transcript-values.php");

// get the record id for the grade
$record_id = ($_GET["record"] == "" ? NULL : (int)$_GET["record"]); // untrusted

// Get the record using the `id` from the DB.
if ($record_id) {
  $records = exec_sql_query(
    $db,
    "SELECT * FROM grades WHERE (id = :id);",
    array(
      ":id" => $record_id
    )
  )->fetchAll();

  // Did we find the record?
  if (count($records) > 0) {
    $record = $records[0]; // first record
  }
} else {
  $record = NULL;
}
?>
<!DOCTYPE html>
<html lang="en">

<?php include "includes/meta.php" ?>

<body>
  <?php include "includes/header.php"; ?>

  <main class="transcript">
    <h2><?php echo $page_title; ?></h2>

    <?php if ($record == NULL) { ?>

      <p>Unknown grade record (<?php echo htmlspecialchars($record_id); ?>).</p>
      <p>Please contact your site administrator for assistance.</p>
      <p>Return to the <a href="/transcript">transcript</a>.

      <?php } else { ?>

      <table>
        <tr>
          <th>Course</th>
          <th>Term</th>
          <th>Academic Year</th>
          <th>Grade</th>
        </tr>

        <tr>
          <td>
            <?php
            $courses_result = exec_sql_query(
              $db,
              "SELECT number FROM courses WHERE (id = :course_id);",
              array(
                ":course_id" => $record["course_id"]
              )
            );
            $course_record = $courses_result->fetchAll()[0];

            echo htmlspecialchars($course_record["number"]);
            ?>
          </td>

          <td>
            <?php echo htmlspecialchars(TERM_CODINGS[$record["term"]]); ?>
          </td>

          <td>
            <?php echo htmlspecialchars(ACADEMIC_YEAR_CODINGS[$record["acad_year"]]); ?>
          </td>

          <td>
            <?php echo htmlspecialchars($record["grade"]); ?>
          </td>
        </tr>
      </table>

      <section>
        <h2>Update Record</h2>

        <form class="insert" action="/transcript/update" method="post">

          <div class="label-input">
            <label for="insert-course">Course:</label>
            <select id="insert-course" name="course" required>
              <option value="" disabled selected>Select Course</option>

              <?php foreach ($courses as $course) { ?>
                <option value="<?php echo htmlspecialchars($course["id"]); ?>">
                  <?php echo htmlspecialchars($course["number"] . ": " . $course["title"]); ?>
                </option>
              <?php } ?>
            </select>
          </div>

          <div class="label-input">
            <label for="insert-term">Term:</label>
            <select id="insert-term" name="term" required>
              <option value="" disabled selected>Select Term</option>

              <?php foreach (TERM_CODINGS as $code => $term) { ?>
                <option value="<?php echo htmlspecialchars($code); ?>">
                  <?php echo htmlspecialchars($term); ?>
                </option>
              <?php } ?>
            </select>
          </div>

          <div class="label-input">
            <label for="insert-year">Academic Year:</label>
            <select id="insert-year" name="year" required>
              <option value="" disabled selected>Select Year</option>

              <?php foreach (ACADEMIC_YEAR_CODINGS as $code => $year) { ?>
                <option value="<?php echo htmlspecialchars($code); ?>">
                  <?php echo htmlspecialchars($year); ?>
                </option>
              <?php } ?>
            </select>
          </div>

          <div class="label-input">
            <label for="insert-grade">Grade:</label>
            <select id="insert-grade" name="grade">
              <option value="">No Grade</option>

              <?php foreach (GRADES as $grade) { ?>
                <option value="<?php echo htmlspecialchars($grade); ?>">
                  <?php echo htmlspecialchars($grade); ?>
                </option>
              <?php } ?>
            </select>
          </div>

          <div class="align-right">
            <button type="submit" name="request-insert">
              Update Record
            </button>
          </div>
        </form>
      </section>

    <?php } ?>

  </main>

  <?php include "includes/footer.php"; ?>
</body>

</html>
