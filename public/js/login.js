document.addEventListener("DOMContentLoaded",()=>{
   const $email=document.querySelector("#exampleInputEmail1");
   const $password=document.querySelector("#exampleInputPassword1");
   const $emailError=document.querySelector("#emailHelp");
   const $passwordError=document.querySelector("#passwordHelp");
   const $submit=document.querySelector("#btn-sub");
   let emailIsValid=false;
   let passwordIsValid=false;


   const getEmailValidation=(email)=>{
       if(
           email!="" && /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)
       ){
           emailIsValid=true;
       }else{
           emailIsValid=false;
       } 
       checkRegisterBtn();  
   };
   
   $email.addEventListener("input",(e)=>{
       getEmailValidation(e.target.value)

       if(!emailIsValid){
           $email.classList.add("is-invalid");
           $emailError.classList.remove("d-none");
           $emailError.removeAttribute("hidden");      
   
        }else{
           $email.classList.remove("is-invalid");
           $emailError.classList.add("d-none");
           $emailError.setAttribute("hidden", "true");
   
        }
   });
   
   const getPasswordValidation=($password)=>{
       if($password!="" && $password.length>4){
          passwordIsValid=true;
       }else{
          passwordIsValid=false;
       }
       checkRegisterBtn();
    };
   
  
   $password.addEventListener("input",(e)=>{
        getPasswordValidation(e.target.value);

        if(!passwordIsValid) {
           $passwordError.removeAttribute("hidden");
        } else {
           $passwordError.setAttribute("hidden", "true");
        }

 });


 const checkRegisterBtn=()=>{
   if(emailIsValid && passwordIsValid){
      $submit.disabled=false;
   }else{
      $submit.disabled=true;}
   };

$submit.addEventListener("click",(e)=>{
   checkRegisterBtn();
});
  
});





// document.addEventListener("DOMContentLoaded",()=>{
//    const $email=document.querySelector("#exampleInputEmail1");
//    const $password=document.querySelector("#exampleInputPassword1");
//    const $emailError=document.querySelector("#emailHelp");
//    const $passwordError=document.querySelector("#passwordHelp");
//    const $submit=document.querySelector("#btn-sub");
//    let emailIsValid=false;
//    let passwordIsValid=false;

  

//    const getEmailValidation=(email)=>{
//       if(
//          email!="" && /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)
//       ){
//          emailIsValid=true;
//       }else{
//          emailIsValid=false;
//       }

//       checkSigninBtn();

//    };
//    const getPasswordValidation=(password)=>{
//       if(password!=""&& password.length>4){
//          passwordIsValid=true;
//       }else{
//          passwordIsValid=false;
//       }
      
//       checkSigninBtn();
//    };

//    const checkSigninBtn=()=>{
//       if(emailIsValid && passwordIsValid){
//          $submit.disabled=false;
//       }else{
//          $submit.disabled=true;

//       }
//    };

//    $submit.addEventListener("click",(e)=>{
//       checkSigninBtn();
//    })

//    $email.addEventListener("input",(e)=>{
//       getEmailValidation(e.target.value)
      
      

//       if(!emailIsValid){
//          $email.classList.add("is-invalid");
//          $emailError.classList.remove("d-none");
//          $emailError.removeAttribute("hidden");      

//       }else{
//          $email.classList.remove("is-invalid");
//          $emailError.classList.add("d-none");
//          $emailError.setAttribute("hidden", "true");

//       }
//    });


//    $password.addEventListener("input",(e)=>{
//       getPasswordValidation(e.target.value);  
//       if(!passwordIsValid) {
//          $passwordError.removeAttribute("hidden");
//       } else {
//          $passwordError.setAttribute("hidden", "true");
//       }

//    });

//    // $emailError.classList.add("d-none");
//    // $passwordError.classList.add("d-none");

// });
