(()=>{
    //ナビゲーション設定
    const $userBtn  = document.querySelector('#user-btn');
    const $userBox = document.querySelector('.user-box');
    const $menuBtn  = document.querySelector('#menu-btn');
    const $navbar = document.querySelector('.header .header-2 .flex .navbar');
    const $header2 = document.querySelector('.header .header-2');
    

    $userBtn.addEventListener('click', function(){
        $userBox.classList.toggle('active');
        $navbar.classList.remove('active');
        $menuBtn.classList.remove('fa-times');
    });

    $menuBtn.addEventListener('click', function(){
        $navbar.classList.toggle('active');
        $menuBtn.classList.toggle('fa-times');
        $userBox.classList.remove('active');
    });


    window.addEventListener('scroll', function(){
        $userBox.classList.remove('active');
        $navbar.classList.remove('active');
        $menuBtn.classList.remove('fa-times');

        if(this.window.scrollY > 60){
            $header2.classList.add('active');
        }else{
            $header2.classList.remove('active');
        }
    });


 




})();