<?php include "../database/Database.php"; ?>
<?php
include "../database/Session.php";
Session::init();
?>

<?php
$db = new Database();
$table = "tbl_books";

if(isset($_REQUEST['submit'])){
    $buy_link = "http://nolink.yet"
$preview = $_FILES["preview"]["name"];
        $preview = $_FILES['preview']['name'];
        $preview_temp = $_FILES['preview']['tmp_name'];
        move_uploaded_file($preview_temp, "../covers/$preview");

        $books = array(            
            'name' => $_POST['name'],
            'author' => $_POST['author'],
            'page' => $_POST['page'],
            'publisher' => $_POST['publisher'],
            'publisher' => $_POST['publisher'],
            'preview' => $preview,
            'year' => $_POST['year'],
            'price' => $_POST['price'],
            'discount' => $_POST['discount'],
            'status' => $_POST['status'],
            'buy_link' => $buy_link,
            'process' => $_POST['process'],
            'review' => $_POST['review'],
            'tags' => $_POST['tags'],
            'buy_priority' => 0,
            'reading' => 0,
            'created' => 0,
            'updated' => 0
        );
        $insert = $db->insert($table, $books);
        // if ($insert) {
        //     $msg = "Data Inserted Succesfully";
        // } else {
        //     $msg = "Data not inserted!";
        // }
        // Session::set('msg', $msg);
        $home_url = '../index.php';
        header('Location: ' . $home_url);
}
// if (isset($_REQUEST['action']) && !empty($_REQUEST['action'])) {
//     if ($_REQUEST['action'] == "add") {
//         $preview = $_FILES["preview"]["name"];
//         $preview = $_FILES['preview']['name'];
//         $preview_temp = $_FILES['preview']['tmp_name'];
//         move_uploaded_file($preview_temp, "../covers/$preview");

//         $books = array(            
//             'name' => $_POST['name'],
//             'author' => $_POST['author'],
//             'publisher' => $_POST['publisher'],
//             'publisher' => $_POST['publisher'],
//             'preview' => $preview,
//             'year' => $_POST['year'],
//             'price' => $_POST['price'],
//             'discount' => $_POST['discount'],
//             'status' => $_POST['status'],
//             'review' => $_POST['review']
//         );
//         $insert = $db->insert($table, $books);
//         if ($insert) {
//             $msg = "Data Inserted Succesfully";
//         } else {
//             $msg = "Data not inserted!";
//         }
//         Session::set('msg', $msg);
//         $home_url = '../index.php';
//         header('Location: ' . $home_url);

//     } elseif ($_REQUEST['action'] == "edit") {
//         $id = $_POST['id'];
//         if (!empty($id)) {
//             $studentData = array(
//                 'name' => $_POST['name'],
//                 'email' => $_POST['email'],
//                 'phone' => $_POST['phone']
//             );
//             $table = "tbl_student";
//             $condition = array('id' => $id);
//             $update = $db->update($table, $studentData, $condition);
//             if ($update) {
//                 $msg = "Data updated Succesfully";
//             } else {
//                 $msg = "Data not updated!";
//             }
//             Session::set('msg', $msg);
//             $home_url = '../index.php';
//             header('Location: ' . $home_url);
//         }
//     } elseif ($_REQUEST['action'] == "delete") {
//         $id = $_GET['id'];
//         if (!empty($id)) {
//             $table = "tbl_student";
//             $condition = array('id' => $id);
//             $delete = $db->delete($table, $condition);
//             if ($delete) {
//                 $msg = "Data Deleted Succesfully";
//             } else {
//                 $msg = "Data not Deleted!";
//             }
//             Session::set('msg', $msg);
//             $home_url = '../index.php';
//             header('Location: ' . $home_url);
//         }
//     }
// }
?>