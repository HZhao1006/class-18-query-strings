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

$page_title = "Flowershop";

$nav_flowershop_class = "active_page";

// key/value coding for samples
const SAMPLE_ID_CODINGS = array(
  "roses" => 1,
  "daisies" => 2,
  "gardenias" => 3
);

// initial page state (hide confirmation message)
$show_confirmation_message = false;

// CSS classes for form feedback messages
$feedback_css_classes = array(
  "name" => "hidden",
  "phone" => "hidden",
  "bouquet" => "hidden"
);

// default form values
$form_values = array(
  "name" => "",
  "phone" => "",
  "bouquet" => ""
);

// default sticky values for form inputs
$sticky_values = array(
  "name" => "",
  "phone" => "",
  "roses" => "",
  "daisies" => "",
  "gardenias" => ""
);

// default sticky values for form inputs
if (isset($_POST["request-sample"])) {

  // Assume the form is valid
  $form_valid = true;

  // Get HTTP request user data
  $form_values["name"] = trim($_POST["name"]); // untrusted
  $form_values["phone"] = trim($_POST["phone"]); // untrusted
  $form_values["bouquet"] = trim($_POST["bouquet"]); // untrusted

  // Name is required; is the name value empty?
  if ($form_values["name"] == "") {
    // no name provided, it"s required!
    // form is not valid
    $form_valid = false;

    // show name feedback message by removing hidden class
    $feedback_css_classes["name"] = "";
  }

  // Phone is required; is the phone value empty?
  if ($form_values["phone"] == "") {
    // no phone provided, it"s required!
    // form is not valid
    $form_valid = false;

    // show phone feedback message by removing hidden class
    $feedback_css_classes["phone"] = "";
  }

  // Bouquet is required; check bouquet type -- only 3 types are valid
  if (!in_array($form_values["bouquet"], array("roses", "daisies", "gardenias"))) {
    // no bouquet provided, it"s required!
    // form is not valid
    $form_valid = false;

    // show bouquet feedback message by removing hidden class
    $feedback_css_classes["bouquet"] = "";
  }

  // If the form is valid, show confirmation message
  if ($form_valid) {
    // insert sample request record into database.
    $result = exec_sql_query(
      $db,
      "INSERT INTO flower_samples (business_name, phone, sample_type) VALUES (:business, :phone_no, :bouquet_type);",
      array(
        ':business' => $form_values['name'],
        ':phone_no' => $form_values['phone'],
        ':bouquet_type' => SAMPLE_ID_CODINGS[$form_values['bouquet']],
      )
    );

    // form is valid, show confirmation message
    $show_confirmation_message = true;
  } else {
    // form was not valid, set sticky values
    $sticky_values["name"] = $form_values["name"];
    $sticky_values["phone"] = $form_values["phone"];

    $sticky_values["roses"] = ($form_values["bouquet"] == "roses" ? "checked" : "");
    $sticky_values["daisies"] = ($form_values["bouquet"] == "daisies" ? "checked" : "");
    $sticky_values["gardenias"] = ($form_values["bouquet"] == "gardenias" ? "checked" : "");
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<?php include "includes/meta.php" ?>

<body>
  <?php include "includes/header.php" ?>

  <main class="flowers">

    <!-- Show the form or the confirmation message, not both. -->
    <?php if (!$show_confirmation_message) { ?>

      <h2><?php echo $page_title; ?></h2>

      <p>Welcome to the 2300 Flower Shop! We are a wholesale supplier of flowers. We specialize in bulk sales of fresh cut-flowers.</p>

      <section>
        <h2>Sample Request Form</h2>

        <p>Our premium quality flowers are the best in Ithaca. See the quality yourself! Use the form below to request a <em>free</em> sample bouquet of roses, daisies, or gardenias.</p>

        <form method="post" action="/flowershop" novalidate>

          <p class="feedback <?php echo $feedback_css_classes["name"]; ?>">Please provide your business" name.</p>

          <div class="label-input">
            <label for="name_field">Business Name:</label>
            <input id="name_field" type="text" name="name" value="<?php echo $sticky_values["name"]; ?>">
          </div>

          <p class="feedback <?php echo $feedback_css_classes["phone"]; ?>">Please provide a contact phone number.</p>

          <div class="label-input">
            <label for="phone_field">Contact Phone:</label>
            <input id="phone_field" type="tel" name="phone" value="<?php echo $sticky_values["phone"]; ?>">
          </div>

          <p class="feedback <?php echo $feedback_css_classes["bouquet"]; ?>">Please select a sample bouquet.</p>

          <div class="form-group label-input" role="group" aria-labelledby="bouquet_head">
            <div id="bouquet_head">
              Bouquet:
            </div>
            <div>
              <div>
                <input type="radio" id="roses_input" name="bouquet" value="roses" <?php echo $sticky_values["roses"]; ?>>
                Roses
              </div>
              <div>
                <input type="radio" id="daisies_input" name="bouquet" value="daisies" <?php echo $sticky_values["daisies"]; ?>>
                <label for="daisies_input">Daisies</label>
              </div>
              <div>
                <input type="radio" id="gardenias_input" name="bouquet" value="gardenias" <?php echo $sticky_values["gardenias"]; ?>>
                <label for="gardenias_input">Gardenias</label>
              </div>
            </div>
          </div>

          <div class="align-right">
            <button type="submit" name="request-sample">
              Request Sample
            </button>
          </div>
        </form>
      </section>

    <?php } else { ?>

      <section>
        <h2>Sample Request Confirmation</h2>

        <p>Thank you, <?php echo htmlspecialchars($form_values["name"]); ?>, for your request. We will contact you at <?php echo htmlspecialchars($form_values["phone"]); ?> to arrange a delivery date, time, and location for your sample <?php echo htmlspecialchars($form_values["bouquet"]); ?> bouquet.</p>

        <p><a href="/flowershop">Request another sample</a>.</p>
      </section>

    <?php } ?>

  </main>

  <?php include "includes/footer.php" ?>
</body>

</html>
