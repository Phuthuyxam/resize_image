<?php /* Template name: Page home */ ?>

<?php get_header();


// if(isset($_GET) && !empty($_GET)){
//     echo 'ádad';
//     echo '<pre>';
// print_r($_GET);
// echo '</pre>';
// }
// echo '<pre>';
// print_r($_POST);
// echo '</pre>';
// echo '<pre>';
// print_r(get_field('questions', 44));
// echo '</pre>';


//         $get_content = get_field('questions',18);
//         echo '<pre>';
//         print_r($get_content);
//         echo '</pre>';

//         foreach($get_content as $key=>$item){
//             $args[$key]['ques_heading'] = $item['ques_heading'];
//             foreach($item['ques_title'] as $k=>$value){
//                 $args[$key]['ques_title']= array(
//                     'ques_cat' => $value['ques_cat'],
//                     'answers' => $value['answers'],
//                 );

//             }

//         }

//         echo '<pre>';
//         print_r($args);
//         echo '</pre>';

?>
<?php

if (isset($_POST) && !empty($_POST)) {
    $error = [];
    if (!isset($_POST['name_']) || empty($_POST['name_'])) {
        $error['name_'] = 'Vui lòng nhập tên';
    }
    if (!isset($_POST['email_']) || empty($_POST['email_'])) {
        $error['email_'] = 'Vui lòng nhập email';
    }
    if (!isset($_POST['field']) || empty($_POST['field'])) {
        $error['field'] = 'Vui lòng nhập Lĩnh vực';
    }
    if (!isset($_POST['year_']) || empty($_POST['year_'])) {
        $error['year_'] = 'Vui lòng nhập Số năm hoạt động';
    }
    if (!isset($_POST['scale_']) || empty($_POST['scale_'])) {
        $error['scale_'] = 'Vui lòng nhập Quy mô nhân sự';
    }
    if (!isset($_POST['radio_import00']) || empty($_POST['radio_import00'])) {
        $error['radio_import00'] = 'Vui lòng chọn Câu trả lời';
    }
    if (!isset($_POST['radio_import01']) || empty($_POST['radio_import01'])) {
        $error['radio_import01'] = 'Vui lòng chọn Câu trả lời';
    }
    if (!isset($_POST['radio_import02']) || empty($_POST['radio_import02'])) {
        $error['radio_import02'] = 'Vui lòng chọn Câu trả lời';
    }
    if (!isset($_POST['radio_import03']) || empty($_POST['radio_import03'])) {
        $error['radio_import03'] = 'Vui lòng chọn Câu trả lời';
    }
    if (!isset($_POST['radio_import04']) || empty($_POST['radio_import04'])) {
        $error['radio_import04'] = 'Vui lòng chọn Câu trả lời';
    }
    if (!isset($_POST['radio_import10']) || empty($_POST['radio_import10'])) {
        $error['radio_import10'] = 'Vui lòng chọn Câu trả lời';
    }
    if (!isset($_POST['radio_import11']) || empty($_POST['radio_import11'])) {
        $error['radio_import11'] = 'Vui lòng chọn Câu trả lời';
    }
    if (!isset($_POST['radio_import12']) || empty($_POST['radio_import12'])) {
        $error['radio_import12'] = 'Vui lòng chọn Câu trả lời';
    }
    if (!isset($_POST['radio_import13']) || empty($_POST['radio_import13'])) {
        $error['radio_import13'] = 'Vui lòng chọn Câu trả lời';
    }
    if (!isset($_POST['radio_import14']) || empty($_POST['radio_import14'])) {
        $error['radio_import14'] = 'Vui lòng chọn Câu trả lời';
    }
    if (empty($error)) {
        $insert_id = wp_insert_post(
            array(
                'post_type' => 'answer',
                'post_title' => $_POST['name_'],
                'post_status' => 'publish'
            )
        );

        update_field('email', $_POST['email_'], $insert_id);
        update_field('field', $_POST['field'], $insert_id);
        update_field('year', $_POST['year_'], $insert_id);
        update_field('scale', $_POST['scale_'], $insert_id);

        $args = [];
        $get_content = get_field('questions', 18);

        foreach ($get_content as $key => $item) {
            $args[$key]['ques_heading'] = $item['ques_heading'];
            foreach ($item['ques_title'] as $k => $value) {
                $args[$key]['ques_title'][] = array(
                    'ques_cat' => $value['ques_cat'],
                    'answers' => stripslashes($_POST['radio_import' . $key . $k . '']),
                    'answer_point' => $_POST['total'][$k]
                );
            }
        }

        // echo '<pre>';
        // print_r($_POST);
        // echo '</pre>';

        // echo '<pre>';
        // print_r($args);
        // echo '</pre>';


        // echo '<pre>';
        // print_r($get_content);
        // echo '</pre>';


        $new_args = array(
            array(
                "ques_heading" => "ádasdashdss",
                "ques_title" => array(
                    array(
                        "ques_cat" => "1 2344",
                        "answers" => "1ádadad",
                        "answer_point" => "1",
                    ),

                    array(
                        "ques_cat" => "1 2344asdadadjahdahd",
                        "answers" => "12131313131313sdsdfsdfsfs",
                        "answer_point" => "1",
                    ),

                )

            ),

            array(
                "ques_heading" => "ádasdashdss",
                "ques_title" => array(
                    array(
                        "ques_cat" => "1 2344",
                        "answers" => "1ádadad",
                        "answer_point" => "1",
                    ),

                    array(
                        "ques_cat" => "1 2344asdadadjahdahd",
                        "answers" => "12131313131313sdsdfsdfsfs",
                        "answer_point" => "1",
                    ),

                )

            )
        );

        update_field('questions', $new_args, $insert_id);
    }

}
?>
<div class="content-wrapper">
    <div class="container">
        <div class="content-custom">
            <form action="" method="post">

                <label for="">A. THÔNG TIN DOANH NGHIỆP</label>
                <div class="form-group">
                    <label for="fullname"> Họ và tên:</label>
                    <input type="text" name="name_" id="name_" class="form-control" value="">
                    <p class="error"><?php if (isset($error['name_'])) {
                            echo $error['name_'];
                        } ?></p>
                </div>
                <div class="form-group">
                    <label for="email_">Email:</label>
                    <input type="email" name="email_" id="email_" class="form-control" value="">
                    <p class="error">
                        <?php if (isset($error['email_']) && !empty($error['email_'])) {
                            echo $error['email_'];
                        } ?>
                    </p>
                </div>
                <div class="form-group">
                    <label for="field">Lĩnh vực:</label>
                    <input type="text" name="field" id="field" class="form-control" value="">
                    <p class="error">
                        <?php if (isset($error['field']) && !empty($error['field'])) {
                            echo $error['field'];
                        } ?>
                    </p>

                </div>

                <div class="form-group">
                    <label for="year">Số năm hoạt động:</label>
                    <input type="text" name="year_" id="year" class="form-control" value="">
                    <p class="error">
                        <?php if (isset($error['year_']) && !empty($error['year_'])) {
                            echo $error['year_'];
                        } ?>
                    </p>

                </div>
                <div class="form-group">
                    <label for="scale">Quy mô nhân sự:</label>
                    <input type="text" name="scale_" id="scale" class="form-control" value="">
                    <p class="error">
                        <?php if (isset($error['scale']) && !empty($error['year'])) {
                            echo $error['scale'];
                        } ?>
                    </p>

                </div>
                <p><b>B. CÂU HỎI TRẮC NGHIỆM</b></p>
                <?php
                $query = new WP_Query(
                    array(
                        'post_status' => 'publish',
                        'post_type' => 'post',
                        'posts_per_page' => -1
                    )
                );

                if ($query->have_posts()) :
                    while ($query->have_posts()) :
                        $query->the_post();

                        $content = get_field('questions');

                        if (isset($content) && !empty($content)) :

                            foreach ($content as $key_master => $item) :
                                ?>
                                <p><b><?php echo $item['ques_heading']; ?></b></p>

                                <?php
                                if (isset($item['ques_title']) && !empty($item['ques_title'])) :
                                    $title = $item['ques_title'];
                                    foreach ($title as $k => $value) : ?>
                                        <div class="ques-wrapper">
                                            <p><b><?php echo $value['ques_cat'] ?> </b></p>
                                            <p class="error">
                                                <?php if (isset($error['radio_import' . $k . '']) && !empty($error['radio_import' . $k . ''])) {
                                                    echo $error['radio_import' . $k . ''];
                                                } ?>
                                            </p>

                                            <?php
                                            if (isset($value['answers']) && !empty($value['answers'])) :
                                                $answer = $value['answers'];
                                                foreach ($answer as $key => $ans) :
                                                    ?>
                                                    <div class="radio">
                                                        <label>
                                                            <input type="radio"
                                                                   name="radio_import<?php echo $key_master ?><?php echo $k ?>"
                                                                   class="radio-btn" id=""
                                                                   value="<?php echo $ans['answer_detail'] ?>">
                                                            <?php echo $ans['answer_detail'] ?>
                                                            <input type="text" class="ans_point"
                                                                   value="<?php echo $ans['answer_point'] ?>">
                                                        </label>

                                                    </div>
                                                <?php
                                                endforeach;
                                                ?>
                                                <input type="text" class="total " name="total[]" value="">

                                            <?php
                                            endif; ?>
                                        </div>

                                    <?php
                                    endforeach;
                                endif;
                                ?>

                            <?php
                            endforeach;
                        endif;
                    endwhile;
                endif;
                wp_reset_query(); ?>

                <div class="btn-wrapper" style="text-align:center">
                    <button type="submit" class="btn btn-primary">Hoàn thành</button>
                </div>
            </form>
        </div>
    </div>
</div>


<?php get_footer() ?>
<script type="text/javascript">
    jQuery(document).ready(function () {
        jQuery('.radio .radio-btn').each(function () {

            jQuery(this).click(function () {
                var point = jQuery(this).parent().find('input.ans_point').val();
                jQuery(this).parents('.ques-wrapper').find('input.total').val(point);
            })
        })
    })
</script>