
  
<span class="cms-content-header">Dashboard</span>
<div class="cms-content-block">

    <div class="cms-dash-stats">

        <span class="cms-dash-stats-item">
                    <span class="cms-dash-stats-item-header"><span class="cms-dash-stats-item-headerf">Available</span></span>
                    <span class="cms-dash-stats-item-content">
                        <span class="cms-dash-stats-item-small">Total</span>
                        
                        <span class="cms-dash-stats-item-large"><?php $count_s = mysqli_num_rows($con->query("SELECT `car_id` FROM `cars` WHERE `status` = '1' "));
                        echo $count_s; 
                        ?></span>
                    </span>
        </span>

        <span class="cms-dash-stats-item">
                    <span class="cms-dash-stats-item-header"><span class="cms-dash-stats-item-headerf">Reserved</span></span>
                    <span class="cms-dash-stats-item-content">
                        <span class="cms-dash-stats-item-small">Total</span>
                        <span class="cms-dash-stats-item-large"><?php $count_s = mysqli_num_rows($con->query("SELECT `car_id` FROM `cars` WHERE `status` = '2' "));
                        echo $count_s; 
                        ?></span>
                    </span>
        </span>

        <span class="cms-dash-stats-item">
                    <span class="cms-dash-stats-item-header"><span class="cms-dash-stats-item-headerf">Sold</span></span>
                    <span class="cms-dash-stats-item-content">
                        <span class="cms-dash-stats-item-small">Total</span>
                        <span class="cms-dash-stats-item-large"><?php $count_s = mysqli_num_rows($con->query("SELECT `car_id` FROM `cars` WHERE `status` = '3' "));
                        echo $count_s; 
                        ?></span>
                    </span>
        </span>

        <span class="cms-dash-stats-item">
                    <span class="cms-dash-stats-item-header"><span class="cms-dash-stats-item-headerf">Cars that are Pre-Owned</span></span>
                    <span class="cms-dash-stats-item-content">
                        <span class="cms-dash-stats-item-small">Total</span>
                        <span class="cms-dash-stats-item-large"><?php $count_s = mysqli_num_rows($con->query("SELECT `car_id` FROM `cars` WHERE `status` > '0' AND `pre_owned` = 1 "));
                        echo $count_s; 
                        ?></span>
                    </span>
        </span>

    </div>

</div>

<script>

</script>