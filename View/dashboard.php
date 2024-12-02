<?php
include 'header.php';
?>
<span class="dashboard">Tableau de bord</span>
<span class="dashboard"><?= $_SESSION['role'] ?> : <?= $_SESSION['username'] ?> <i class="bi bi-circle-fill blink"></i></span>
</div>
</nav>

<div class="home-content">
    <div class="overview-boxes">
        <div class="box">
            <div>
                <div class="box-txt">Nombre total de personnel</div>
                <div class="number"><?php echo getTotalPersonnel(); ?></div>
            </div>
            <i class="bi bi-person"></i>
        </div>
        <div class="box">
            <div>
                <div class="box-txt">Personnel avec plus d'un an de service</div>
                <div class="number"><?php echo getPersonnelPlusUnAn(); ?></div>
            </div>
            <i class="bi bi-clock"></i>
        </div>
        <div class="box">
            <div>
                <div class="box-txt">Personnel ayant pris des congés</div>
                <div class="number"><?php echo getPersonnelAvecConges(); ?></div>
            </div>
            <i class="bi bi-calendar-check"></i>
        </div>
    </div>
    <div class="overview-boxes">
        <div class="chart-container">
            <?php include 'graphe.php'; ?>
        </div>
    </div>
</div>


<?php
include 'footer.php';
?>