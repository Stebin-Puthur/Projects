<div class="container">
<div class="row m-3">
    <div class="col-md-12">
        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Address</th>
                <th scope="col">Email</th>
                <th scope="col">Phone</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
                <?php
                global $post;
                $args = array(
                    'post_type' => 'form',
                    'post_status' => 'publish',
                    'posts_per_page' => 100,
                    'orderby' => 'id',
                    'order' => 'DESC',
                );
                $the_query = new WP_Query($args);

                if ($the_query->have_posts()) {
                    while ($the_query->have_posts()) : $the_query->the_post();
                ?>
                        <form action="" method="post">
                <?php
                echo "<tr>";
                        $taxonomies = get_post_taxonomies();
                        foreach ($taxonomies as $taxonomy) {

                            $terms = get_terms([
                                'taxonomy' => $taxonomy,
                                'hide_empty' => false,
                            ]);
                            $values = array();

                            foreach ($terms as $term) {
//                                echo $term->name;
                                echo "<td>" . $term->name . "</td><br>";
                            }

                        }
                    echo "<td>
                            <button type='submit' class='btn btn-success btn-sm' name='update'>Update</button>
                            <button type='submit' class='btn btn-danger btn-sm' name='delete'>Delete</button>
                        </td>";
                echo "</tr>";
                    endwhile;
                };
                ?>
            </tbody>
        </table>
    </div>
</div>
</div>


