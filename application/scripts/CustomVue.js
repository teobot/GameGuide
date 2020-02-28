var app = new Vue({
    // Add the id here.
    el: '#commentSection',
    data: {
      comments:[]
    }, 
    created() {
      this.getComments();
    },   
    methods: {
      getComments:function()
      {
        var pathArray = window.location.pathname.split('/');
        $.get("http://localhost/PHPFrameworks/index.php/getComments",{"slug":pathArray[4]}, function(data){
          console.log(data);
          app.comments = data;
        });
        
      },
    }
});

var profile_images = new Vue({
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