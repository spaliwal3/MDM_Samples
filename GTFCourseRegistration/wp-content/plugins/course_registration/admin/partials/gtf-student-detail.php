<?php

/**
 *
 * GTF student detail page.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    course_registration
 * @subpackage course_registration/admin/partials
 */

?>
<h3>Extra student profile information</h3>
      <table class="form-table">
          <tr>
              <th><label for="last_4_ssn">Last 4 digits of SSN</label></th>
              <td>
                  <input type="text" name="last_4_ssn" id="last_4_ssn" value="<?php echo esc_attr( get_the_author_meta( 'last_4_ssn', $user->ID ) ); ?>" class="regular-text" /><br />
                  <span class="description">Please enter the last 4 digits SSN of the user.</span>
              </td>
          </tr>
          <tr>
            <th><label for='address'>Address</label></th>
                <td>
                    <input type="text" name="address" id="address" value="<?php echo esc_attr( get_the_author_meta( 'address', $user->ID ) ); ?>" class="regular-text" /><br />
                </td>
          </tr>
          <tr>
            <th><label for='job_title'>Job Title</label></th>
                <td>
                    <input type="text" name="job_title" id="job_title" value="<?php echo esc_attr( get_the_author_meta( 'job_title', $user->ID ) ); ?>" class="regular-text" /><br />
                </td>
          </tr>
            <tr>
                <th><label for='year_of_experience'>Year of experience</label></th>
                    <td>
                        <input type="text" name="year_of_experience" id="year_of_experience" value="<?php echo esc_attr( get_the_author_meta( 'year_of_experience', $user->ID ) ); ?>" class="regular-text" /><br />
                    </td>
            </tr>
          <tr>
            <th><label for='dietary_needs'>Dietary Needs</label></th>
                <td>
                    <input type="text" name="dietary_needs" id="dietary_needs" value="<?php echo esc_attr( get_the_author_meta( 'dietary_needs', $user->ID ) ); ?>" class="regular-text" /><br />
                </td>
          </tr>
          <tr>
            <th><label for='registed_courses'>Registed Programs</label></th>
              <td>
                <?php
                $courses = get_posts(
                  array(
                  'post_type' => 'course',
                  'post_status' => array('publish', 'pending', 'draft', 'future', 'private', 'inherit'),
                  'orderby'   => 'post__in',
                ));
                if($courses){
                  foreach($courses as $course){
                    $cname = $course->post_title;
                    $cid = $course->ID;
                    //$cid = get_post_meta($course->ID, 'eventbrite_event_id', true);
                    $checked = get_the_author_meta( 'registed_courses', $user->ID );
                ?>
                      <input type="checkbox" name="registed_courses[]"
                      <?php if(!empty($checked) and in_array($cid, $checked)){ echo 'checked';  } ?>
                      value="<?php echo esc_attr($cid); ?>"/>
              <?php echo esc_attr($cname); ?>
                      <br />
                    <?php
                  }
                } ?>
              </td>
          </tr>
      </table>
