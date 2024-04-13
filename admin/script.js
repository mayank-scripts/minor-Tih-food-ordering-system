
      var profileContainer=document.querySelector(".profileContainer");
      var disc=document.querySelector("#disc")
      var alert=document.querySelector(".alert-wrapper");
      var disc=document.querySelector("#disc");
      var dis=document.querySelector("#dismis");
      var cartpage=document.querySelector(".cart");
      var kart=document.querySelector("#kart");
      var passwordInputs = document.querySelectorAll('input[type="password"]');
      var showcheck=document.querySelector("#showcheck");
      var pass=document.querySelector("#forget-password");
      var user=document.querySelector("#forget-username");
      var loginBox=document.querySelector(".login-box");
      var x=document.querySelector("#login2");
      var y=document.querySelector("#singup");
      var color=document.querySelector(".login-btn-color");
      var btn = document.querySelector("#mob");
      var dropdown = document.querySelector(".dropdown");
      btn.addEventListener("click",function(){
        dropdown.classList.toggle('open');
      })
        function singup(){
          x.style.left="1000px";
          y.style.left="31px";
          color.style.left="50%";
          user.style.left="1000px";
          pass.style.left="1000px";
        }
        function login(){
          x.style.left="31px";
          y.style.left="1000px";
          color.style.left="0px";
          user.style.left="1000px";
          pass.style.left="1000px";
        }
        function logindrop(){
          loginBox.classList.toggle('active')
        }
        function toggleProfile(){
          profileContainer.classList.toggle('run')
        }
        function forgetusername(){
          x.style.left="1000px";
          y.style.left="1000px";
          user.style.left="10%";
          pass.style.left="1000px";
        }
        function forgetpassword(){
          x.style.left="1000px";
          y.style.left="1000px";
          pass.style.left="10%";
          user.style.left="1000px";
        }
        function passwordinput(){
          showcheck.click();
          if(showcheck.checked){
             passwordInputs.forEach(input => {
             input.type = "text";
           });
          }
          else{
           passwordInputs.forEach(input => {
             input.type = "password";
           });
        }
      }
      function cart(){
          kart.click();
          if(kart.checked){
            cartpage.style.right="0px"
          }
          else{
            cartpage.style.right="-1000px";
          }
        }
        function dissmiss(){
          disc.click();
            if(disc.checked){
             alert.style.display='none';
            }
        }
      if(window.history.replaceState){
        window.history.replaceState(null,null,window.location.href);
      }
    