(()=>{
    //ヘッダーナビゲーション設定
    const $menuBtn = document.querySelector('#menu-btn');
    const $navBar = document.querySelector('.header .flex .navbar');
    const $userBtn = document.querySelector('#user-btn');
    const $accountBox = document.querySelector('.header .flex .account-box');

    $menuBtn.addEventListener('click', function(){
        $navBar.classList.toggle('active');
        $menuBtn.classList.toggle('fa-times');
        $accountBox.classList.remove('active');
    });

    $userBtn.addEventListener('click', function(){
        $accountBox.classList.toggle('active');
        $navBar.classList.remove('active');
        $menuBtn.classList.remove('fa-times');
    });


    window.addEventListener('scroll', function(){
        $navBar.classList.remove('active');
        $menuBtn.classList.remove('fa-times');
        $accountBox.classList.remove('active');
    });


    //モーダルウィンドウ設定
    const $closeUpdate = document.querySelector('#close-update');
    const $editFrom = document.querySelector('.edit-product-form');
    const $editBtn = document.querySelectorAll('#edit-btn');

    $closeUpdate.addEventListener('click', function(){
        $editFrom.classList.toggle('active');
    });


    

})();