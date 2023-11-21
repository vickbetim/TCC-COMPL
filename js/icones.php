<!-- css dos icones -->

@import url('https://fonts.googleapis.com/css?family-Outfit:wght@300&display=swap');
*{   
 margin: 0;
 padding: 0;
 box-sizing: border-box;
 font-family: 'Outfit', sans-serif;
}
body{
    heigth: 100vh;

}
 nav.menu-lateral{
    width: 80px;
    height: 100%;
    background-color: #000;
    padding: 40xp 0 40xp 1%;
    box-shadow: 3px 0 0 #ff0077;

     
    top: 0;
    left: 0;
    overflow: hidden;
    transition: .2s;
 }
 nav.menu-lateral: houver{
    width: 300px;
 }
 .btn-expandir{
    width: 100%;
    padding-left:10px;
 }
 .btn-expandir >1{
  color: #fff;
  font-size: 24px;
  cursor: pointer;
 }

 ul{
    height: 100%;
    list-style-type: none;
 }

 ul li.item-menu{
    transition: .2s;
 }

 ul li.item-menu: houver{
    background: #ff0077;
 }

 ul li.item-menu a{
    color:#fff 
    text-decoration: none;
    font-size: 20px;
    padding: 20px 4%;
    display: flex;
    margin-bottom: 20px;
    line-height: 40px;
 }
 ul li.item-menu a .txt-link{
    margin-left: 40px;
 }

 ul li.item-menu a .icon>i {
    font-size 30xp;
    margin-left: 10px;
 }

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<nav class="menu-lateral">
    <div class="btn-expandir">
    <i class="bi bi-list"></i>
    <ul>
        <li class="item-menu">
            <a href="#">
                <span class="incon"><i class="bi bi-house-check"></i></span>
                <span class="txt-link">home</span>
            </a>
        </li>
        <li class="item-menu">
            <a href="#">
                <span class="incon"><i class="bi bi-basket"></i></span>
                <span class="txt-link">produtos</span>
            </a>
        </li>
    </ul>
    </div>
</nav>