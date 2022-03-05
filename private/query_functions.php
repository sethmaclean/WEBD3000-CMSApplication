<?php

  // contacts

  // finds all contacts in the database
  function find_all_contacts() {
    global $db;

    $sql = "SELECT * FROM tblContacts ";
    $sql .= "ORDER BY id ASC";
    //echo $sql;
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
  }

  // finds contacts based on month in the date field
  function find_contacts_by_birthday($month) {
    global $db;

    $sql = "SELECT * FROM tblContacts WHERE monthname(dateOfBirth) = '$month' ";
    //echo $sql;
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
  }

  // finds contacts based on their ID
  function find_contact_by_id($id) {
    global $db;

    $sql = "SELECT * FROM tblContacts ";
    $sql .= "WHERE id='" . db_escape($db, $id) . "'";
    // echo $sql;
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $contact = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $contact; // returns an assoc. array
  }

  //validates the contact form data before inserting into the database
  function validate_contact($contact) {
    foreach($contact as $key => $value) {
      if ($key == 'email') {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
          $errors[] = "Email is not valid (Ex: johnsmith@gmail.com).";
        }
      }
      if ($key == 'phone') {
        if (!preg_match('/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/', $value)) {
          $errors[] = "Phone is not valid (Ex: xxx-xxx-xxxx).";
        }
      }
      if ($key == 'postalCode') {
        if (!preg_match('/^[A-Za-z]\d[A-Za-z][ -]?\d[A-Za-z]\d$/', $value)) {
          $errors[] = "Postal Code is not valid (Ex: T2T 1T2).";
        }
      }
      if ($key == 'province') {
        if (!preg_match('/^[A-Za-z]{2}$/', $value)) {
          $errors[] = "Province is not valid (Ex: ON).";
        }
      }
      if ($key == 'city') {
        if (!preg_match('/^[A-Za-z]{2,20}$/', $value)) {
          $errors[] = "City is not valid (Ex: Toronto).";
        }
      }
      if ($key == 'address') {
        if (!preg_match('/^[A-Za-z0-9\s]{2,30}$/', $value)) {
          $errors[] = "Address is not valid (Ex: 123 Main St).";
        }
      }
      if ($key == 'firstName') {
        if (!preg_match('/^[A-Za-z]{2,20}$/', $value)) {
          $errors[] = "First Name is not valid (Ex: John).";
        }
      }
      if ($key == 'lastName') {
        if (!preg_match('/^[A-Za-z]{2,20}$/', $value)) {
          $errors[] = "Last Name is not valid (Ex: Smith).";
        }
      }
      if ($key == 'dateOfBirth') {
        if (!preg_match('/^[0-9]{4}-[0-1][0-9]-[0-3][0-9]$/', $value)) {
          $errors[] = "Date of Birth is not valid (Ex: 1990-01-01).";
        }
      }
      if ($key == 'userName') {
        if (!preg_match('/^[A-Za-z0-9]{2,20}$/', $value)) {
          $errors[] = "User Name is not valid (Ex: JohnSmith01).";
        }
      }
    }

    return $errors;
  }

  // inserts a new contact into the database if it passes validation
  function insert_contact($contact) {
    global $db;

    $errors = validate_contact($contact);
    if(!empty($errors)) {
      return $errors;
    }

    $sql = "INSERT INTO tblContacts ";
    $sql .= "(firstName, lastName, phone, email, address, city, province, postalCode, dateOfBirth, userName) ";
    $sql .= "VALUES (";
    $sql .= "'" . db_escape($db, $contact['firstName']) . "',";
    $sql .= "'" . db_escape($db, $contact['lastName']) . "',";
    $sql .= "'" . db_escape($db, $contact['phone']) . "',";
    $sql .= "'" . db_escape($db, $contact['email']) . "',";
    $sql .= "'" . db_escape($db, $contact['address']) . "',";
    $sql .= "'" . db_escape($db, $contact['city']) . "',";
    $sql .= "'" . db_escape($db, $contact['province']) . "',";
    $sql .= "'" . db_escape($db, $contact['postalCode']) . "',";
    $sql .= "'" . db_escape($db, $contact['dateOfBirth']) . "',";
    $sql .= "'" . db_escape($db, $contact['userName']) . "'";
    $sql .= ")";
    $result = mysqli_query($db, $sql);
    // For INSERT statements, $result is true/false
    if($result) {
      return true;
    } else {
      // INSERT failed
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }

  // updates a contact in the database if it passes validation
  function update_contact($contact) {
    global $db;

    $errors = validate_contact($contact);
    if(!empty($errors)) {
      return $errors;
    }

    $sql = "UPDATE tblContacts SET ";
    $sql .= "firstName='" . db_escape($db, $contact['firstName']) . "', ";
    $sql .= "lastName='" . db_escape($db, $contact['lastName']) . "', ";
    $sql .= "phone='" . db_escape($db, $contact['phone']) . "', ";
    $sql .= "email='" . db_escape($db, $contact['email']) . "', ";
    $sql .= "address='" . db_escape($db, $contact['address']) . "', ";
    $sql .= "city='" . db_escape($db, $contact['city']) . "', ";
    $sql .= "province='" . db_escape($db, $contact['province']) . "', ";
    $sql .= "postalCode='" . db_escape($db, $contact['postalCode']) . "', ";
    $sql .= "dateOfBirth='" . db_escape($db, $contact['dateOfBirth']) . "', ";
    $sql .= "userName='" . db_escape($db, $contact['userName']) . "' ";
    $sql .= "WHERE id='" . db_escape($db, $contact['id']) . "' ";
    $sql .= "LIMIT 1";

    $result = mysqli_query($db, $sql);
    // For UPDATE statements, $result is true/false
    if($result) {
      return true;
    } else {
      // UPDATE failed
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }

  }

  // deletes a contact from the database
  function delete_contact($id) {
    global $db;

    $sql = "DELETE FROM tblContacts ";
    $sql .= "WHERE id='" . db_escape($db, $id) . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);

    // For DELETE statements, $result is true/false
    if($result) {
      return true;
    } else {
      // DELETE failed
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }

   // Admins

  // Find all users ordered last_name and then first_name
  function find_all_admins() {
    global $db;

    $sql = "SELECT * FROM tblUsers ";
    $sql .= "ORDER BY lastName ASC, firstName ASC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
  }

  // finds an admin by id
  function find_admin_by_id($id) {
    global $db;

    $sql = "SELECT * FROM tblUsers ";
    $sql .= "WHERE id='" . db_escape($db, $id) . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $admin = mysqli_fetch_assoc($result); // find first
    mysqli_free_result($result);
    return $admin; // returns an assoc. array
  }

  // finds an admin by username
  function find_admin_by_username($username) {
    global $db;

    $sql = "SELECT * FROM tblusers ";
    $sql .= "WHERE username='" . db_escape($db, $username) . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $admin = mysqli_fetch_assoc($result); // find first
    mysqli_free_result($result);
    return $admin; // returns an assoc. array
  }

  // log in an admin based on the id
  function log_in_admin($admin) {
   $_SESSION['admin_id'] = $admin['id'];
    $_SESSION['username'] = $admin['username'];
    return true;
  }

  // login veritifcation for admin only
  function require_admin_login() {
    if($_SESSION['username'] !== 'admin') {
      redirect_to(url_for('index.php'));
      exit;
    } else {
      return true;
    }
  }

  // login veritifcation for users and admin
  function require_user_login() {
    if(!isset($_SESSION['username'])) {
      redirect_to(url_for('index.php'));
      exit;
    } else {
      return true;
    }
  }

  // trims the input if it is not empty
  function is_blank($value) {
    return !isset($value) || trim($value) === '';
  }

?>