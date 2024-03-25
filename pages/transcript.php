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

// --- Insert Form Data ---

// Did the user submit the insert form?
if (isset($_POST["request-insert"])) {

  $form_values["class_num"] = ($_POST["course"] == "" ? NULL : (int)$_POST["course"]); // untrusted
  $form_values["term"]      = ($_POST["term"]   == "" ? NULL : (int)$_POST["term"]); // untrusted
  $form_values["year"]      = ($_POST["year"]   == "" ? NULL : (int)$_POST["year"]); // untrusted
  $form_values["grade"]     = ($_POST["grade"]  == "" ? NULL : $_POST["grade"]); // untrusted

  $result = exec_sql_query(
    $db,
    "INSERT INTO grades (course_id, term, acad_year, grade) VALUES (:course, :term, :acad_year, :grade);",
    array(
      ":course"    => $form_values["class_num"], // tainted/untrusted
      ":term"      => $form_values["term"], // tainted/untrusted
      ":acad_year" => $form_values["year"], // tainted/untrusted
      ":grade"     => $form_values["grade"] // tainted/untrusted
    )
  );
}

// --- Select Query Data ---

// CSS classes for sort arrows
$sort_css_classes = array(
  "course_asc" => "inactive",
  "course_desc" => "inactive",
  "term_asc" => "inactive",
  "term_desc" => "inactive",
  "year_asc" => "inactive",
  "year_desc" => "inactive",
  "credits_asc" => "inactive",
  "credits_desc" => "inactive",
  "grade_asc" => "inactive",
  "grade_desc" => "inactive",
);

// TODO: get the "sort" query string parameter
$sort_param = NULL;

// TODO: get the "order" query string parameter
$order_param = NULL;

// validate order parameter.
// sort must be "course", "term", "year", or "grade"
if (in_array($sort_param, array("course", "term", "year", "credits", "grade"))) {

  // Table sorter icon should match current sort
  if ($order_param == "asc") {
    $sort_css_classes[$sort_param . "_asc"] = "";
    $sort_css_classes[$sort_param . "_desc"] = "hidden";
  } else if ($order_param == "desc") {
    $sort_css_classes[$sort_param . "_asc"] = "hidden";
    $sort_css_classes[$sort_param . "_desc"] = "";
  }
}

// query grades table
$records = exec_sql_query($db, "SELECT
  grades.id AS 'grades.id',
  courses.number AS 'courses.number',
  courses.credits AS 'courses.credits',
  grades.term AS 'grades.term',
  grades.acad_year AS 'grades.acad_year',
  grades.grade AS 'grades.grade'
FROM grades INNER JOIN courses ON (grades.course_id = courses.id);")->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">

<?php include "includes/meta.php" ?>

<body>
  <?php include "includes/header.php" ?>

  <main class="transcript">
    <h2><?php echo $page_title; ?></h2>

    <table>
      <tr>
        <th class="column-course">
          <!-- TODO: add "sort" and "order" query string parameters to URL -->
          <a class="sort" href="/transcript" aria-label="Sort by Course Number">
            Course
            <svg class="icon" version="1.1" viewBox="0 0 2.1391 4.2339" xmlns="http://www.w3.org/2000/svg">
              <g transform="translate(-38.257 -61.073)">
                <path class="sort_desc <?php echo $sort_css_classes["course_desc"]; ?>" d="m40.396 63.455-1.0695 1.8521-1.0695-1.8521z" />
                <path class="sort_asc <?php echo $sort_css_classes["course_asc"]; ?>" d="m40.396 62.925h-2.1391l1.0695-1.8521z" />
              </g>
            </svg>
          </a>
        </th>

        <th class="column-term">
          <!-- TODO: add "sort" and "order" query string parameters to URL -->
          <a class="sort" href="/transcript" aria-label="Sort by Term">
            Term
            <svg class="icon" version="1.1" viewBox="0 0 2.1391 4.2339" xmlns="http://www.w3.org/2000/svg">
              <g transform="translate(-38.257 -61.073)">
                <path class="sort_desc <?php echo $sort_css_classes["term_desc"]; ?>" d="m40.396 63.455-1.0695 1.8521-1.0695-1.8521z" />
                <path class="sort_asc <?php echo $sort_css_classes["term_asc"]; ?>" d="m40.396 62.925h-2.1391l1.0695-1.8521z" />
              </g>
            </svg>
          </a>
        </th>

        <th class="column-year">
          <!-- TODO: add "sort" and "order" query string parameters to URL -->
          <a class="sort" href="/transcript" aria-label="Sort by Academic Year">
            Year
            <svg class="icon" version="1.1" viewBox="0 0 2.1391 4.2339" xmlns="http://www.w3.org/2000/svg">
              <g transform="translate(-38.257 -61.073)">
                <path class="sort_desc <?php echo $sort_css_classes["year_desc"]; ?>" d="m40.396 63.455-1.0695 1.8521-1.0695-1.8521z" />
                <path class="sort_asc <?php echo $sort_css_classes["year_asc"]; ?>" d="m40.396 62.925h-2.1391l1.0695-1.8521z" />
              </g>
            </svg>
          </a>
        </th>

        <th class="column-credits">
          <!-- TODO: add "sort" and "order" query string parameters to URL -->
          <a class="sort" href="/transcript" aria-label="Sort by Academic Credits">
            Credits
            <svg class="icon" version="1.1" viewBox="0 0 2.1391 4.2339" xmlns="http://www.w3.org/2000/svg">
              <g transform="translate(-38.257 -61.073)">
                <path class="sort_desc <?php echo $sort_css_classes["credits_desc"]; ?>" d="m40.396 63.455-1.0695 1.8521-1.0695-1.8521z" />
                <path class="sort_asc <?php echo $sort_css_classes["credits_asc"]; ?>" d="m40.396 62.925h-2.1391l1.0695-1.8521z" />
              </g>
            </svg>
          </a>
        </th>

        <th class="column-grade">
          <!-- TODO: add "sort" and "order" query string parameters to URL -->
          <a class="sort" href="/transcript" aria-label="Sort by Grade">
            Grade
            <svg class="icon" version="1.1" viewBox="0 0 2.1391 4.2339" xmlns="http://www.w3.org/2000/svg">
              <g transform="translate(-38.257 -61.073)">
                <path class="sort_desc <?php echo $sort_css_classes["grade_desc"]; ?>" d="m40.396 63.455-1.0695 1.8521-1.0695-1.8521z" />
                <path class="sort_asc <?php echo $sort_css_classes["grade_asc"]; ?>" d="m40.396 62.925h-2.1391l1.0695-1.8521z" />
              </g>
            </svg>
          </a>
        </th>

        <th class="min">
          Update
        </th>
      </tr>

      <?php
      // write a table row for each record
      foreach ($records as $record) {
        $course = $record["courses.number"];
        $term = TERM_CODINGS[$record["grades.term"]];
        $year = ACADEMIC_YEAR_CODINGS[$record["grades.acad_year"]];
        $grade = $record["grades.grade"] ?? "";
        $credits = $record["courses.credits"];

        // row partial
        include "includes/transcript-record.php";
      } ?>

    </table>

    <section>
      <h2>Add Student Course Record</h2>

      <form class="insert" action="/transcript" method="post">

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
            Add Course Record
          </button>
        </div>
      </form>
    </section>

  </main>

  <?php include "includes/footer.php" ?>
</body>

</html>
