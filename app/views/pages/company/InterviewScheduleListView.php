<?php require APPROOT . '/views/includes/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>css/company.css">
<?php require APPROOT . '/views/includes/navbar.php'; ?>

<section id="Interview-list" class="main-content">
  <div class="common_list">

    <div class="common_list_content">
      
      <table class="common-table">
        <tr>
          <th>Advertisement Name</th>
          <th>Interns Count</th>
          <th>Status</th>
          <th>Schedule</th>
         
        </tr>

        <?php foreach ($data['advertisements'] as $advertisement) : ?>
            <tr>
                <td><?php echo $advertisement->position ?></td>
                <td><?php echo $advertisement->intern_count ?></td>
                <td><?php echo $advertisement->schedule_status == 0 ? 'Not Scheduled' : 'Scheduled'; ?></td>
                <td><div class="scheduleBtn"><a href="<?php echo URLROOT; ?>companies/interview-schedule-create/<?php echo $advertisement->advertisement_id; ?>" class="common-blue-btn">Schedule</a></div></td>
            </tr>
        <?php endforeach; ?>
      </table>
    </div>

  </div>

</section>

<?php require APPROOT . '/views/includes/footer.php'; ?>