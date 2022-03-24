# archiveForSchool
Archive will be hold student arts

## Back button session

if you are in searchPage.php after had been in categirePage.php session variable turn to true
and $session turn to 1, but if you open searchPage.php after had been in mainPage.php
### PHP code
```PHP
$session = 0;
if($_SESSION['backButtonMainPage'] == true) {
  $session = 1;
}
```
### JS code
```JS
let session = <?php echo json_encode($session); ?>;
if(session == 1) {
  backButton.href = "categoriesPage.php";
}
else {
  backButton.href = "mainPage.php";
}
```


## To do
- [x] create JSON file for classes and profies lists
- [ ] frontend for admin panel
- [ ] $_SESSION varaible for back button in admin_panel and main_page

