var commentElement = new Vue({
    //This is the VueJs section for getting the comments from a specific review
    el: '#commentSection',
    data: {
      comments:[]
    }, 
    //Once the element has loaded, go get the comments.
    created() {
      this.getComments();
    },   
    methods: {
      //Get the comments by posting the slug to the getComments function that returns all the comments JSON encoded
      getComments:function()
      {
        //Split the URL up and get the slug, ready for posting
        var pathArray = window.location.pathname.split('/');
        //Post the slug to get the comments on the specific review
        $.get("http://localhost/PHPFrameworks/index.php/getComments",{"slug":pathArray[4]}, function(data){
          //Set the current comments to the returned data
          commentElement.comments = data;
        });
        
      },
      postComment:function() {
        //This is when a user wants to post a comment onto the review
        //serializeArray turns a form into a JSON object, Since we only have one input it returns the comment the user wants to push
        var comment = $("#postCommentForm").serializeArray();
        //Get the slug from the URL
        var pathArray = window.location.pathname.split('/');

        $.post("http://localhost/PHPFrameworks/index.php/postComment",{ "slug":pathArray[4], "comment":comment[0].value }, function(data){
          //SHOW A SUBMITTED TEXT
          commentElement.getComments();
        });
      }
    }
});

var profile_images = new Vue({
  //This is the profilePicture select,
  //The images are dynamically added based on the first of images below,
  //If you want to add a new possible profile image, add the image location down below.
  el: '#profile_image_selection',
  data: {
    images:[
      "https://moonvillageassociation.org/wp-content/uploads/2018/06/default-profile-picture1.jpg",
      "https://store.playstation.com/store/api/chihiro/00_09_000/container/US/en/999/UP1675-CUSA11816_00-AV00000000000044/1580198354000/image?w=240&h=240&bg_color=000000&opacity=100&_version=00_09_000",
      "https://store.playstation.com/store/api/chihiro/00_09_000/container/US/en/999/UP5588-CUSA16013_00-AV00000000000044/1580197048000/image?w=240&h=240&bg_color=000000&opacity=100&_version=00_09_000",
      "https://store.playstation.com/store/api/chihiro/00_09_000/container/US/en/999/UP1112-CUSA06917_00-AV00000000000180/1580207723000/image?w=240&h=240&bg_color=000000&opacity=100&_version=00_09_000",
      "https://store.playstation.com/store/api/chihiro/00_09_000/container/US/en/999/UP5325-CUSA15500_00-AV00000000000003/1580197389000/image?w=240&h=240&bg_color=000000&opacity=100&_version=00_09_000",
      "https://store.playstation.com/store/api/chihiro/00_09_000/container/US/en/999/UP5588-CUSA16013_00-AV00000000000047/1580197046000/image?w=240&h=240&bg_color=000000&opacity=100&_version=00_09_000",
    ]
  }, 
});