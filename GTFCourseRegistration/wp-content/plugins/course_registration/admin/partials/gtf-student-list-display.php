<?php

/**
 *
 * GTF student list page display.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    course_registration
 * @subpackage course_registration/admin/partials
 */

?>
<div class="wrap">
    <h2> Student List</h2>
    <div class="row">
	<div class='col-md-8'>
		<table class="widefat">
			<thead>
				<tr>
					<th>Student</th>
					<th>Email</th>
					<th>Registed Program</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<th>Student</th>
					<th>Email</th>
					<th>Registed Program</th>
			</tfoot>
			<tbody>
				<?php
        $courses_all = '';
				foreach ($students as &$student) {
					$email = $student->data->user_email;
					$name = $student->data->display_name;
					$courses_id = get_user_meta($student->data->ID, 'registed_courses', true);
          //compose data-filter
          $data_filter = '';
          foreach($courses_id as $cid){
            $id = (string)$cid;
            $data_filter = $data_filter . $id . ' ';
          }
          echo '<tr class="course_id ' . $data_filter . '">'
					?>
						<td>
							<a href='#'
                 data-toggle="modal"
                 data-id="<?php echo $student->data->ID ?>"
                 data-target="#student<?php echo $student->data->ID; ?>"
                 class="open-AddBookDialog">
                  <?php echo esc_attr($name) ?>
              </a>

              <!--  Modal -->
              <div class="modal fade" id="student<?php echo $student->data->ID; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h3 class="modal-title" id="studentInfoModalLabel"> Student Information</h3>
                    </div>
                    <div class="modal-body" id="studentId">

                    <h4> Personal Information </h4>
                      <table class="table table-striped">
                      <tr>
                          <th><label for="name">Name</label></th>
                          <td>
                              <?php echo $student->data->display_name; ?>
                          </td>
                      </tr>
                      <tr>
                          <th><label for="last_4_ssn">Last 4 digits of SSN</label></th>
                          <td>
                              <?php
                                if(get_the_author_meta( 'last_4_ssn', $student->ID )){
                                  $last_4_ssn = esc_attr(get_the_author_meta( 'last_4_ssn', $student->ID )) ;
                                  echo "<p> $last_4_ssn </p>";
                                }
                                else{
                                  echo "";
                                }
                                ?>
                          </td>
                      </tr>
                      <tr>
                          <th><label for="degree">Degree</label></th>
                          <td>
                              <?php
                                if(get_the_author_meta( 'degree', $student->ID )){
                                  $degree = get_user_meta( 'degree', $student->ID ) ;
                                  echo "<p> $degree </p>";
                                }
                                else{
                                  echo "";
                                }
                                ?>
                          </td>
                      </tr>
                      <tr>
                          <th><label for="job_title">Job Title</label></th>
                          <td>
                              <?php
                                if(get_the_author_meta( 'job_title', $student->ID )){
                                  $job_title = esc_attr(get_the_author_meta( 'job_title', $student->ID )) ;
                                  echo "<p> $job_title </p>";
                                }
                                else{
                                  echo "";
                                }
                                ?>
                          </td>
                      </tr>
                      <tr>
                          <th><label for="work_facility">Work Facility</label></th>
                          <td>
                              <?php
                                if(get_the_author_meta( 'work_facility', $student->ID )){
                                  $work_facility = esc_attr(get_the_author_meta( 'work_facility', $student->ID )) ;
                                  echo "<p> $work_facility </p>";
                                }
                                else{
                                  echo "";
                                }
                                ?>
                          </td>
                      </tr>
                      <tr>
                          <th><label for="dietary_needs">Dietary Needs</label></th>
                          <td>
                              <?php
                                if(get_the_author_meta( 'dietary_needs', $student->ID )){
                                  $dietary_needs = esc_attr(get_the_author_meta( 'dietary_needs', $student->ID )) ;
                                  echo "<p> $dietary_needs </p>";
                                }
                                else{
                                  echo "";
                                }
                                ?>
                          </td>
                      </tr>
                      </table>

                      <h4> Contact Information </h4>
                      <table class="table table-striped">
                      <tr>
                          <th><label for="address1">Address Line 1</label></th>
                          <td>
                              <?php echo esc_attr(get_the_author_meta( 'address1', $student->ID )) ;?>
                          </td>
                      </tr>
                      <tr>
                          <th><label for="address2">Address Line 2</label></th>
                          <td>
                              <?php echo esc_attr( get_the_author_meta( 'address2', $student->ID ) ); ?>
                          </td>
                      </tr>
                      <tr>
                          <th><label for="city"> City </label></th>
                          <td>
                              <?php echo esc_attr(get_the_author_meta( 'city', $student->ID )) ; ?>
                          </td>
                      </tr>
                      <tr>
                          <th><label for="county"> County </label></th>
                          <td>
                              <?php  echo esc_attr(get_the_author_meta( 'county', $student->ID )) ;?>
                          </td>
                      </tr>
                      <tr>
                          <th><label for="state"> State </label></th>
                          <td>
                              <?php  echo esc_attr(get_the_author_meta( 'state', $student->ID )) ;?>
                          </td>
                      </tr>
                      <tr>
                          <th><label for="cellphone">Phone</label></th>
                          <td>
                              <?php
                                if(get_the_author_meta( 'cellphone', $student->ID )){
                                  $cellphone = esc_attr(get_the_author_meta( 'cellphone', $student->ID )) ;
                                  echo "<p> $cellphone </p>";
                                }
                                else{
                                  echo "";
                                }
                                ?>
                          </td>
                      </tr>
                      </table>

                      <table class="table table-striped">
                      <h4> Trauma Experience </h4>
                      <tr>
                          <th><label for="year_of_experience">Year of Experience </label></th>
                          <td>
                              <?php echo esc_attr(get_the_author_meta( 'year_of_experience', $student->ID )) ;?>
                          </td>
                      </tr>
                      <tr>
                          <th><label for="work_department">Department Worked </label></th>
                          <td>
                              <?php echo esc_attr(get_the_author_meta( 'work_department', $student->ID )) ;?>
                          </td>
                      </tr>
                      <tr>
                          <th><label for="email">E-mail </label></th>
                          <td>
                              <?php echo esc_attr($email);?>
                          </td>
                      </tr>
                      </table>
                      <table class="table table-striped">
                      <h4> Registed Program </h4>
                        <thead>
                          <tr>
                            <th>Program Name</th>
                            <th>Start Date</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                            $courses_id = get_user_meta($student->data->ID, 'registed_courses', true);
                            foreach($courses_id as $cid)
                            {
                                $course = get_post($cid);
                                if($course != null){
                                ?>
                                  <tr>
                                    <td><?php echo $course->post_title; ?></td>
                                    <td><?php echo get_post_meta($cid, 'start_date', true); ?></td>
                                  </tr>
                              <?php
                                }
                            }?>
                        </tbody>


                      </table>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
              </div>
            </td>
						<td>
							<?php echo esc_attr($email); ?>
						</td>
						<td>
							<?php
							foreach($courses_id as $cid){
								$course = get_post($cid);
                if ($course != null)
                {
                    $link = get_permalink($cid);
								    echo '<a href=' . $link . '>' . $course->post_title . '</a></div><br>' ;
                  }
							}
							?>
						</td>
					</tr>
          </div>
				<?php
				}
			?>
			</tbody>
		</table>
	</div>

    <div class="col-md-4">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Filter by Program</h3>
        </div>

        <!-- List courses -->
        <ul class="list-group">
        <a href="#" class="list-group-item active">All</a>
        <?php
        $args = array(
          'offset'           => 0,
          'category'         => '',
          'category_name'    => '',
          'orderby'          => 'date',
          'order'            => 'DESC',
          'include'          => '',
          'exclude'          => '',
          'meta_key'         => '',
          'meta_value'       => '',
          'post_type'        => 'course',
          'post_mime_type'   => '',
          'post_parent'      => '',
          'author'     => '',
          'post_status'      => array('publish', 'pending', 'draft', 'future', 'private', 'inherit'),
        );
        $courses_array = get_posts( $args );
        foreach ($courses_array as $course){
          echo '<a href="#" class="list-group-item" val="' . $course->ID . '">' . $course->post_title . '</a>' ;
        }
        ?>
        </ul>
    </div>
</div>
</div>
</div>


<script>
jQuery(document).ready(function($){
  $("ul").children("a").click(function(){
    var course_id = ""

    // make the link selected
    $("ul").children("a").removeClass('active');
    $(this).addClass('active');

    // add action to table
    if ($(this).attr("val"))
    {
      course_id = course_id.concat(".", $(this).attr("val").toString());
      $("tr").filter('.course_id').not(course_id).hide();
      $("tr").filter(course_id).show();
    }
    else
    {
      // when select all
      $("tr").filter('.course_id').show()
    }
    //console.log(course_id);
  });
});
</script>


