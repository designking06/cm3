<??>
<?php
try{

// Set your secret key: remember to change this to your live secret key in production
// See your keys here: https://dashboard.stripe.com/account/apikeys
\Stripe\Stripe::setApiKey("sk_live_Cs9W5geHJt7RhWFWJh6IdX3i");

// Token is created using Checkout or Elements!
// Get the payment token ID submitted by the form:
$token = $_POST['stripeToken'];
$amount = $_POST['amount'];
$description = $_POST['description'];

$charge = \Stripe\Charge::create([
    'amount' => $amount,
    'currency' => 'usd',
    'description' => $description,
    'source' => $token,
]);
} catch(\Stripe\Error\Card $e) {
  // Since it's a decline, \Stripe\Error\Card will be caught
  $alert = "Your transaction didnt go through, please try again.";
  header('location:index.php?alert='.$alert);
  /*
  $body = $e->getJsonBody();
  $err  = $body['error'];

  print('Status is:' . $e->getHttpStatus() . "\n");
  print('Type is:' . $err['type'] . "\n");
  print('Code is:' . $err['code'] . "\n");
  // param is '' in this case
  print('Param is:' . $err['param'] . "\n");
  print('Message is:' . $err['message'] . "\n");
  */
} catch (\Stripe\Error\RateLimit $e) {
  // Too many requests made to the API too quickly
  $alert = "The site crashed because of too much activity, please try again";
  header('location:index.php?#productRow?alert='.$alert);
} catch (\Stripe\Error\InvalidRequest $e) {
  // Invalid parameters were supplied to Stripe's API
    $alert = "An error occured, please try again [37]";
    header('location:index.php?#productRow?alert='.$alert);
} catch (\Stripe\Error\Authentication $e) {
  // Authentication with Stripe's API failed
  // (maybe you changed API keys recently)
    $alert = "An error occured, please try again [41]";
    header('location:index.php?#productRow?alert='.$alert);
} catch (\Stripe\Error\ApiConnection $e) {
  // Network communication with Stripe failed
  $alert = "A connection error occured, please try again [44]";
  header('location:index.php?#productRow?alert='.$alert);
} catch (\Stripe\Error\Base $e) {
  // Display a very generic error to the user, and maybe send
  // yourself an email
  $alert = "An error occured, please try again [48]";
  header('location:index.php?#productRow?alert='.$alert);
} catch (Exception $e) {
  // Something else happened, completely unrelated to Stripe
  $alert = "An error occured, please check your connection and try again [51]";
  header('location:index.php?#productRow?alert='.$alert);
}
?>
