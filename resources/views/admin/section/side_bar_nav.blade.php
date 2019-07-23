<nav class="side_nav col-md-2 d-none d-md-block bg-light sidebar">
    <div class="nav-side-menu">
        <div class="brand">دیکشنری آنلاین</div>
        <i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>

        <div class="menu-list">
            <ul id="menu-content" class="menu-content collapse out">
                <li class=" {{ coolText("") }} ">
                    <a href="/admin">
                        <i class="fa fa-dashboard fa-lg"></i> میز کار
                    </a>
                </li>
                <li class=" {{ coolText("words") }} ">
                    <a href="/admin/word">
                        <i class="fa fa-book fa-lg"></i>لغت نامه انگلیسی
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<?php
use Illuminate\Support\Facades\Route;
function coolText($text) {
    return (Route::currentRouteName() == $text)? "active" : " ";
}