# archiveForSchool
Archive will be hold student arts

## Back button
Java Script have function with get last open page. I use this function to 
### code
```HTML
<a href="javascript: history.go(-1)">Back</a>
```

## Delete user
If you select student to delete and click delte button will show you confirm alert
### JS code
```JS
let confirmAlert = confirm("Are you shure to delte this user?");
//value of checbox will be user_id
let check = document.querySelector("#check");

if(confirmAlert == true) {
  if(check.checked) {
    let checkValue = check.value;
    $ajax({
      url: "delete_user.php",
      method: "post",
      data: {user_id: checkValue},
      success: function() {
        return true;
      }
    });
  }
}
```


## To do
- [x] create JSON file for classes and profies lists
- [ ] frontend for admin panel
- [x] add user button in <strong>searchPage.php</strong> table

