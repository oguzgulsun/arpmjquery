    @include('components.header')


    <style>
    .main {
    position: relative;
    background-color: #000;
    width:400px;
    margin: auto;
    height: 400px;
    display: flex;
    align-items: center;
    justify-content: center
}

.main_ball {
    position: absolute;
    width: 60px;
    height: 60px;
    background-color: #fff;
    border-radius: 50%;
    top:calc(50% - 30px);
    animation: moveBall 4s linear infinite;
}

.main_text {
    color: #fff;
    font-size: 36px!important;
    mix-blend-mode: difference;
}

@keyframes moveBall {
    0%, 100% {
        left: 10%;
    }
    50% {
        left: 80%;
    }
}
    </style>
    <div class="main">
        <div class="main_ball"></div>
        <h1 class="main_text">Welcome to ARPM!</h1>
    </div>
    

    @include('components.footer')