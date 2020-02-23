var app = new Vue({
    // Add the id here.
    el: '#commentSection',
    data: {
      heading:"test",
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