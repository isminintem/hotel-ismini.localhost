document.addEventListener("DOMContentLoaded",()=>{
    const $username=document.querySelector("#username");
    const $email=document.querySelector("#exampleInputEmail1");
    const $password=document.querySelector("#exampleInputPassword1");
    const $emailError=document.querySelector("#emailHelp");
    const $passwordError=document.querySelector("#passwordHelp");
    const $nameError=document.querySelector("#nameHelp")
    const $submit=document.querySelector("#sub-btn");
    let emailIsValid=false;
    let passwordIsValid=false;
    let nameIsValid=false;

    const getNameValidation=(username)=>{
      if(
         username!="" && /^[0-9A-Za-z]{6,16}$/.test(username)
      ){
         nameIsValid=true;
      }else{
         nameIsValid=false;
      }
      checkRegisterBtn();
   };
   
   $username.addEventListener("input",(e)=>{
      getNameValidation(e.target.value)

      if(!nameIsValid) {
         $nameError.removeAttribute("hidden");
      } else {
         $nameError.setAttribute("hidden", "true");
      }

   });



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
    
    const getPasswordValidation=(password)=>{
        if(password!="" && password.length>4){
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
    if(emailIsValid && passwordIsValid && nameIsValid){
       $submit.disabled=false;
    }else{
       $submit.disabled=true;}
    };

 $submit.addEventListener("click",(e)=>{
    checkRegisterBtn();
 });
   //  $emailError.classList.add("d-none");
   //  $passwordError.classList.add("d-none");


});
