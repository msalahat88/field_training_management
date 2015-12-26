<link href="<?= site_url('include/css/dashboard.css') ?>" rel="stylesheet">
<link href="<?= site_url('include/ext/bootstrap-table.css') ?>" rel="stylesheet">
<script src="<?= site_url('include/ext/bootstrap-table.js') ?>"></script>
<div class="col-sm-3 col-md-2 sidebar">
    <ul class="nav nav-sidebar">
        <li><a href="<?= site_url('admin/home') ?>">Home</a></li>
        <li><a href="<?= site_url('admin/user_site') ?>">User site</a></li>
        <li><a href="<?= site_url('admin/country') ?>">Country</a></li>
        <li><a href="<?= site_url('admin/section_food') ?>">Section food</a></li>
        <li><a href="<?= site_url('admin/food') ?>">Food</a></li>
        <li><a href="<?= site_url('admin/image_food') ?>">Image food</a></li>
        <li class="active"><a href="<?= site_url('admin/customer') ?>">Customer</a></li>
        <li><a href="<?= site_url('admin/order_customer') ?>">Order customer</a></li>
        <li><a href="<?= site_url('admin/order_items') ?>">Order items</a></li>
        <li><a href="<?= site_url('admin/shipping_type') ?>">Shipping type</a></li>
        <li><a href="<?= site_url('admin/status_order') ?>">Status order</a></li>
        <li><a href="<?= site_url('admin/category') ?>">Category</a></li>
        <li><a href="<?= site_url('admin/post') ?>">Post</a></li>
        <li><a href="<?= site_url('admin/slider') ?>">Slider</a></li>
        <li><a href="<?= site_url('admin/tag_keyword') ?>">Tag keyword</a></li>
    </ul>
</div>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <?PHP
    $use = new class_loader();
    $use->use_lib('db/tpl_customer');
    $use->use_lib('db/tpl_user_site');
    $use->use_lib('system/bootstrap/class_massage');
    ?>
    <h2 class="sub-header"><?= tpl_customer::customer() ?>s</h2>

    <div class="col-sm-12">
        <p id="status_massage"></p>
    </div>
    <div id="toolbar">
        <button id="add_new_btn" class="btn btn-success btn-xs">New <?= tpl_customer::customer() ?></button>
        </br>

    </div>
    <div class="table-responsive">
        <table id="table" data-toggle="table"
               data-url="<?= site_url('admin/' . tpl_customer::customer() . '/find_all_ajax') ?>"
               data-cache="false" data-height="400" data-show-refresh="true" data-show-toggle="true"
               data-show-columns="true" data-pagination="true" data-page-list="[5, 10, 20, 50, 100, 200]"
               data-search="true" data-flat="true" data-toolbar="#toolbar">
            <thead>
            <tr>
                <th data-field="<?= tpl_customer::id() ?>" data-halign="center" data-sortable="true"> ID</th>
                <th data-field="<?= tpl_customer::f_name() ?>" data-halign="center" data-sortable="true"> First Name
                </th>
                <th data-field="<?= tpl_customer::l_name() ?>" data-halign="center" data-sortable="true"> Last Name</th>
                <th data-field="<?= tpl_customer::email() ?>" data-halign="center" data-sortable="true"> Email</th>
                <th data-field="<?= tpl_customer::username() ?>" data-halign="center" data-sortable="true"> Username
                </th>

                <th data-field="<?= tpl_customer::password() ?>" data-halign="center" data-sortable="true"
                    data-formatter="operate<?= tpl_customer::password() ?>"
                    > Password
                </th>
                <th data-field="<?= tpl_customer::phone() ?>" data-halign="center" data-sortable="true"> Phone</th>
                <th data-field="<?= tpl_customer::mobile() ?>" data-halign="center" data-sortable="true"> Mobile</th>
                <th data-field="<?= tpl_customer::address() ?>" data-halign="center" data-sortable="true"> Address</th>
                <th data-field="<?= tpl_customer::full_address() ?>" data-halign="center" data-sortable="true"> Full
                    Address
                </th>
                <th data-field="<?= tpl_customer::customer() . '_' . tpl_user_site::name() ?>" data-halign="center"
                    data-sortable="true"> Username
                </th>
                <th data-field="<?= tpl_customer::status() ?>" data-halign="center" data-sortable="true"
                    data-formatter="operate<?= tpl_customer::status() ?>"
                    > Status
                </th>

                <th
                    data-field="operate"
                    data-formatter="operateFormatter"
                    data-events="operateEvents"
                    data-align="center"
                    >Action
                </th>

            </tr>
            </thead>
        </table>
    </div>

</div>
</div>
</div>

<script type="text/javascript">
    function operate<?= tpl_customer::status() ?>(value, row) {
        if (value == 1) {
            return '<input onchange="update_status(' + row.<?= tpl_customer::id() ?> + ',0)" type="checkbox" checked="true"/>';
        }
        return '<input onchange="update_status(' + row.<?=tpl_customer::id() ?> + ',1)" type="checkbox"/>';
    }
    function update_status(id, value) {
        $(document).ready(function () {
            $.post('<?= site_url('admin/'.tpl_customer::customer().'/update_status')?>',
                {
                    '<?=tpl_customer::customer().'_'.tpl_customer::id() ?>': id,
                    '<?=tpl_customer::customer().'_'.tpl_customer::status()?>': value
                }, function (result) {
                    var $table = $('#table');
                    $table.bootstrapTable('showLoading');
                    $table.bootstrapTable('refresh');
                }).fail(function () {
                    alert("Error");
                });
        });
    }
</script>


<script type="text/javascript">
    function operate<?= tpl_customer::password() ?>(value, row) {

        return '<small onclick="update_password(' + row.<?= tpl_customer::id() ?> + ')">Password</small>';
    }
    function update_password(id) {
        $(document).ready(function () {
            $('#update_password').modal('show');
            $('#<?=tpl_customer::customer().'_'.tpl_customer::id().'_update_password'?>').val(id);
        });
    }

</script>


<script type="text/javascript">
    function operateFormatter(value, row, index) {
        return [
            '<a class="remove ml10" href="javascript:void(0)" title="Remove">',
            '<i class="glyphicon glyphicon-remove"></i>',
            '</a>',
            '<a class="update ml10" href="javascript:void(0)" title="Remove">',
            '<i class="glyphicon glyphicon-edit"></i>',
            '</a>'

        ].join('');
    }
    window.operateEvents = {
        'click .remove': function (e, value, row, index) {
            if (confirm("Did you actually want to delete the <?=tpl_customer::customer()?>!")) {
                $.post('<?= site_url('admin/'.tpl_customer::customer().'/remove')?>', {'<?=tpl_customer::customer().'_'.tpl_customer::id()?>': row.<?=tpl_customer::id()?>}, function (result) {
                    var data = JSON.parse(result);
                    if (data['valid']) {
                        $('#status_massage').html(<?=class_massage::info('title','massage')?>);
                        window.setTimeout(function () {
                            $('#status_massage').html('');
                        }, 2000);
                    } else {
                        $('#status_massage').html(<?=class_massage::danger('title','massage')?>);
                    }
                    var $table = $('#table');
                    $table.bootstrapTable('showLoading');
                    $table.bootstrapTable('refresh');
                });
            }
        },
        'click .update': function (e, value, row, index) {
            $('#update').modal('show');
            $('#<?=tpl_customer::customer().'_'.tpl_customer::id().'_update'?>').val(row.<?=tpl_customer::id()?>);
            $('#<?=tpl_customer::customer().'_'.tpl_customer::f_name().'_update'?>').val(row.<?=tpl_customer::f_name()?>);
            $('#<?=tpl_customer::customer().'_'.tpl_customer::l_name().'_update'?>').val(row.<?=tpl_customer::l_name()?>);
            $('#<?=tpl_customer::customer().'_'.tpl_customer::email().'_update'?>').val(row.<?=tpl_customer::email()?>);
            $('#<?=tpl_customer::customer().'_'.tpl_customer::username().'_update'?>').val(row.<?=tpl_customer::username()?>);
            $('#<?=tpl_customer::customer().'_'.tpl_customer::password().'_update'?>').val(row.<?=tpl_customer::password()?>);
            $('#<?=tpl_customer::customer().'_'.tpl_customer::phone().'_update'?>').val(row.<?=tpl_customer::phone()?>);
            $('#<?=tpl_customer::customer().'_'.tpl_customer::mobile().'_update'?>').val(row.<?=tpl_customer::mobile()?>);
            $('#<?=tpl_customer::customer().'_'.tpl_customer::address().'_update'?>').val(row.<?=tpl_customer::address()?>);
            $('#<?=tpl_customer::customer().'_'.tpl_customer::full_address().'_update'?>').val(row.<?=tpl_customer::full_address()?>);
        }
    };

    $(document).ready(function () {

        $('#add_new_btn').click(function () {
            $('#add').modal('show');
        });
        $('#add_new').bootstrapValidator({
            message: 'This value is not valid',
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                '<?=tpl_customer::customer().'_'.tpl_customer::f_name()?>': {
                    validators: {notEmpty: {message: 'The field is required and can\'t be empty'}}
                }

                , '<?=tpl_customer::customer().'_'.tpl_customer::l_name()?>': {
                    validators: {notEmpty: {message: 'The field is required and can\'t be empty'}}
                }

                , '<?=tpl_customer::customer().'_'.tpl_customer::email()?>': {
                    validators: {notEmpty: {message: 'The field is required and can\'t be empty'}}
                }

                , '<?=tpl_customer::customer().'_'.tpl_customer::username()?>': {
                    validators: {notEmpty: {message: 'The field is required and can\'t be empty'}}
                }

                , '<?=tpl_customer::customer().'_'.tpl_customer::password()?>': {
                    validators: {notEmpty: {message: 'The field is required and can\'t be empty'}}
                }

                , '<?=tpl_customer::customer().'_'.tpl_customer::phone()?>': {
                    validators: {notEmpty: {message: 'The field is required and can\'t be empty'}}
                }

                , '<?=tpl_customer::customer().'_'.tpl_customer::mobile()?>': {
                    validators: {notEmpty: {message: 'The field is required and can\'t be empty'}}
                }

                , '<?=tpl_customer::customer().'_'.tpl_customer::address()?>': {
                    validators: {notEmpty: {message: 'The field is required and can\'t be empty'}}
                }

                , '<?=tpl_customer::customer().'_'.tpl_customer::full_address()?>': {
                    validators: {notEmpty: {message: 'The field is required and can\'t be empty'}}
                }
            }
        }).on('success.form.bv', function (e) {
            e.preventDefault();
            var $form = $(e.target);
            var bv = $form.data('bootstrapValidator');
            $.post($form.attr('action'), $form.serialize(), function (result) {
                var data = JSON.parse(result);
                if (data['valid']) {
                    $('#result_massages_save').html(<?=class_massage::info('title','massage')?>);
                    var $table = $('#table');
                    $table.bootstrapTable('showLoading');
                    $table.bootstrapTable('refresh');
                    window.setTimeout(function () {
                        $('#add').modal('hide');
                    }, 2000);
                } else {
                    $('#result_massages_save').html(<?=class_massage::danger('title','massage')?>);
                }
            }).fail(function () {
            });
        });

        $('#update_form').bootstrapValidator({
            message: 'This value is not valid',
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                '<?=tpl_customer::customer().'_'.tpl_customer::f_name().'_update'?>': {
                    validators: {notEmpty: {message: 'The field is required and can\'t be empty'}}
                }
                ,
                '<?=tpl_customer::customer().'_'.tpl_customer::id().'_update'?>': {validators: {notEmpty: {message: 'The field is required and can\'t be empty'}}}

                ,
                '<?=tpl_customer::customer().'_'.tpl_customer::f_name().'_update'?>': {
                    validators: {notEmpty: {message: 'The field is required and can\'t be empty'}}
                }

                ,
                '<?=tpl_customer::customer().'_'.tpl_customer::l_name().'_update'?>': {
                    validators: {notEmpty: {message: 'The field is required and can\'t be empty'}}
                }
                ,
                '<?=tpl_customer::customer().'_'.tpl_customer::email().'_update'?>': {
                    validators: {notEmpty: {message: 'The field is required and can\'t be empty'}}
                }
                ,
                '<?=tpl_customer::customer().'_'.tpl_customer::username().'_update'?>': {
                    validators: {notEmpty: {message: 'The field is required and can\'t be empty'}}
                }
                ,
                '<?=tpl_customer::customer().'_'.tpl_customer::password().'_update'?>': {
                    validators: {notEmpty: {message: 'The field is required and can\'t be empty'}}
                }
                ,
                '<?=tpl_customer::customer().'_'.tpl_customer::phone().'_update'?>': {
                    validators: {notEmpty: {message: 'The field is required and can\'t be empty'}}
                }
                ,
                '<?=tpl_customer::customer().'_'.tpl_customer::mobile().'_update'?>': {
                    validators: {notEmpty: {message: 'The field is required and can\'t be empty'}}
                }
                ,
                '<?=tpl_customer::customer().'_'.tpl_customer::address().'_update'?>': {
                    validators: {notEmpty: {message: 'The field is required and can\'t be empty'}}
                }
                ,
                '<?=tpl_customer::customer().'_'.tpl_customer::full_address().'_update'?>': {
                    validators: {notEmpty: {message: 'The field is required and can\'t be empty'}}
                }
            }
        }).on('success.form.bv', function (e) {
            e.preventDefault();
            var $form = $(e.target);
            var bv = $form.data('bootstrapValidator');
            $.post($form.attr('action'), $form.serialize(), function (result) {
                var data = JSON.parse(result);

                if (data['valid']) {
                    $('#result_massages_update').html(<?=class_massage::info('title','massage')?>);
                    var $table = $('#table');
                    $table.bootstrapTable('showLoading');
                    $table.bootstrapTable('refresh');
                    window.setTimeout(function () {
                        $('#update').modal('hide');
                    }, 2000);
                } else {
                    $('#result_massages_update').html(<?=class_massage::danger('title','massage')?>);
                }
            }).fail(function () {
            });
        });


        $('#update_password_form').bootstrapValidator({
            message: 'This value is not valid',
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                '<?=tpl_customer::customer().'_'.tpl_customer::password().'_update_password'?>': {
                    validators: {notEmpty: {message: 'The field is required and can\'t be empty'}}
                }
                , '<?=tpl_customer::customer().'_'.tpl_customer::id().'_update_password'?>': {
                    validators: {
                        notEmpty: {message: 'The field is required and can\'t be empty'}

                    }
                }
                , '<?=tpl_customer::customer().'_'.tpl_customer::password().'_r_update_password'?>': {
                    validators: {
                        notEmpty: {message: 'The field is required and can\'t be empty'},
                        identical: {
                            field: '<?=tpl_customer::customer().'_'.tpl_customer::password().'_update_password'?>',
                            message: 'The password and its confirm are not the same'
                        }
                    }
                }
            }
        }).on('success.form.bv', function (e) {
            e.preventDefault();
            var $form = $(e.target);
            var bv = $form.data('bootstrapValidator');
            $.post($form.attr('action'), $form.serialize(), function (result) {
                var data = JSON.parse(result);

                if (data['valid']) {
                    $('#result_massages_update_password').html(<?=class_massage::info('title','massage')?>);
                    var $table = $('#table');
                    $table.bootstrapTable('showLoading');
                    $table.bootstrapTable('refresh');
                    window.setTimeout(function () {
                        $('#update_password').modal('hide');
                        $('#result_massages_update_password').html('');
                    }, 2000);
                } else {
                    $('#result_massages_update_password').html(<?=class_massage::danger('title','massage')?>);
                }
            }).fail(function () {
            });
        });
    });
</script>
<div class="modal fade" id="add" style="background-color: rgba(60, 60, 60, 0.81);" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width: 50%">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4>New <?= tpl_customer::customer() ?>
                    <small id="TitlePostSmall"></small>
                </h4>
            </div>
            <div class="modal-body">
                <form class="form" id="add_new" method="post"
                      action="<?= site_url('admin/' . tpl_customer::customer() . '/insert') ?>">
                    <div class="form-group">
                        <label for="Edit_NameCategory">First Name <?= tpl_customer::customer() ?>: </label>
                        <input type="text" class="form-control"
                               id="<?= tpl_customer::customer() . '_' . tpl_customer::f_name() ?>"
                               name="<?= tpl_customer::customer() . '_' . tpl_customer::f_name() ?>"/>
                    </div>

                    <div class="form-group">
                        <label for="Edit_NameCategory">Last Name <?= tpl_customer::customer() ?>: </label>
                        <input type="text" class="form-control"
                               id="<?= tpl_customer::customer() . '_' . tpl_customer::l_name() ?>"
                               name="<?= tpl_customer::customer() . '_' . tpl_customer::l_name() ?>"/>
                    </div>

                    <div class="form-group">
                        <label for="Edit_NameCategory">Email <?= tpl_customer::customer() ?>: </label>
                        <input type="text" class="form-control"
                               id="<?= tpl_customer::customer() . '_' . tpl_customer::email() ?>"
                               name="<?= tpl_customer::customer() . '_' . tpl_customer::email() ?>"/>
                    </div>


                    <div class="form-group">
                        <label for="Edit_NameCategory">Username <?= tpl_customer::customer() ?>: </label>
                        <input type="text" class="form-control"
                               id="<?= tpl_customer::customer() . '_' . tpl_customer::username() ?>"
                               name="<?= tpl_customer::customer() . '_' . tpl_customer::username() ?>"/>
                    </div>


                    <div class="form-group">
                        <label for="Edit_NameCategory">Password <?= tpl_customer::customer() ?>: </label>
                        <input type="text" class="form-control"
                               id="<?= tpl_customer::customer() . '_' . tpl_customer::password() ?>"
                               name="<?= tpl_customer::customer() . '_' . tpl_customer::password() ?>"/>
                    </div>

                    <div class="form-group">
                        <label for="Edit_NameCategory">Phone <?= tpl_customer::customer() ?>: </label>
                        <input type="text" class="form-control"
                               id="<?= tpl_customer::customer() . '_' . tpl_customer::phone() ?>"
                               name="<?= tpl_customer::customer() . '_' . tpl_customer::phone() ?>"/>
                    </div>


                    <div class="form-group">
                        <label for="Edit_NameCategory">Mobile <?= tpl_customer::customer() ?>: </label>
                        <input type="text" class="form-control"
                               id="<?= tpl_customer::customer() . '_' . tpl_customer::mobile() ?>"
                               name="<?= tpl_customer::customer() . '_' . tpl_customer::mobile() ?>"/>
                    </div>


                    <div class="form-group">
                        <label for="Edit_NameCategory">Address <?= tpl_customer::customer() ?>: </label>
                        <input type="text" class="form-control"
                               id="<?= tpl_customer::customer() . '_' . tpl_customer::address() ?>"
                               name="<?= tpl_customer::customer() . '_' . tpl_customer::address() ?>"/>
                    </div>

                    <div class="form-group">
                        <label for="Edit_NameCategory">Full Address <?= tpl_customer::customer() ?>: </label>
                        <input type="text" class="form-control"
                               id="<?= tpl_customer::customer() . '_' . tpl_customer::full_address() ?>"
                               name="<?= tpl_customer::customer() . '_' . tpl_customer::full_address() ?>"/>
                    </div>
                    <button type="submit" class="btn btn-success">Save</button>
                </form>
                <div class="" id="result_massages_save"></div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="update" style="background-color: rgba(60, 60, 60, 0.81);" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width: 50%">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4>Update <?= tpl_customer::customer() ?>
                    <small id="TitlePostSmall"></small>
                </h4>
            </div>
            <div class="modal-body">
                <form class="form" id="update_form" method="post"
                      action="<?= site_url('admin/' . tpl_customer::customer() . '/update') ?>">

                    <div class="form-group">
                        <input type="hidden"
                               name="<?= tpl_customer::customer() . '_' . tpl_customer::id() . '_update' ?>"
                               id="<?= tpl_customer::customer() . '_' . tpl_customer::id() . '_update' ?>" value=""/>
                    </div>

                    <div class="form-group">
                        <label for="">First Name <?= tpl_customer::customer() ?> : </label>
                        <input type="text" class="form-control"
                               id="<?= tpl_customer::customer() . '_' . tpl_customer::f_name() . '_update' ?>"
                               name="<?= tpl_customer::customer() . '_' . tpl_customer::f_name() . '_update' ?>"/>
                    </div>

                    <div class="form-group">
                        <label for="">Last Name <?= tpl_customer::customer() ?> : </label>
                        <input type="text" class="form-control"
                               id="<?= tpl_customer::customer() . '_' . tpl_customer::l_name() . '_update' ?>"
                               name="<?= tpl_customer::customer() . '_' . tpl_customer::l_name() . '_update' ?>"/>
                    </div>

                    <div class="form-group">
                        <label for="">Email <?= tpl_customer::customer() ?> : </label>
                        <input type="text" class="form-control"
                               id="<?= tpl_customer::customer() . '_' . tpl_customer::email() . '_update' ?>"
                               name="<?= tpl_customer::customer() . '_' . tpl_customer::email() . '_update' ?>"/>
                    </div>
                    <div class="form-group">
                        <label for="">Username <?= tpl_customer::customer() ?> : </label>
                        <input type="text" class="form-control"
                               id="<?= tpl_customer::customer() . '_' . tpl_customer::username() . '_update' ?>"
                               name="<?= tpl_customer::customer() . '_' . tpl_customer::username() . '_update' ?>"/>
                    </div>

                    <div class="form-group">
                        <label for="">Phone <?= tpl_customer::customer() ?> : </label>
                        <input type="text" class="form-control"
                               id="<?= tpl_customer::customer() . '_' . tpl_customer::phone() . '_update' ?>"
                               name="<?= tpl_customer::customer() . '_' . tpl_customer::phone() . '_update' ?>"/>
                    </div>

                    <div class="form-group">
                        <label for="">Mobile <?= tpl_customer::customer() ?> : </label>
                        <input type="text" class="form-control"
                               id="<?= tpl_customer::customer() . '_' . tpl_customer::mobile() . '_update' ?>"
                               name="<?= tpl_customer::customer() . '_' . tpl_customer::mobile() . '_update' ?>"/>
                    </div>

                    <div class="form-group">
                        <label for="">Address <?= tpl_customer::customer() ?> : </label>
                        <input type="text" class="form-control"
                               id="<?= tpl_customer::customer() . '_' . tpl_customer::address() . '_update' ?>"
                               name="<?= tpl_customer::customer() . '_' . tpl_customer::address() . '_update' ?>"/>
                    </div>

                    <div class="form-group">
                        <label for="">Full address <?= tpl_customer::customer() ?> : </label>
                        <input type="text" class="form-control"
                               id="<?= tpl_customer::customer() . '_' . tpl_customer::full_address() . '_update' ?>"
                               name="<?= tpl_customer::customer() . '_' . tpl_customer::full_address() . '_update' ?>"/>
                    </div>
                    <button type="submit" class="btn btn-success" id="update" name="update">Save</button>
                </form>
                <div class="" id="result_massages_update"></div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="update_password" style="background-color: rgba(60, 60, 60, 0.81);" tabindex="-1"
     role="dialog"
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width: 50%">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4>Update <?= tpl_customer::customer() ?> Password
                    <small id="TitlePostSmall"></small>
                </h4>
            </div>
            <div class="modal-body">
                <form class="form" id="update_password_form" method="post"
                      action="<?= site_url('admin/' . tpl_customer::customer() . '/update_password') ?>">

                    <div class="form-group">
                        <input type="hidden"
                               name="<?= tpl_customer::customer() . '_' . tpl_customer::id() . '_update_password' ?>"
                               id="<?= tpl_customer::customer() . '_' . tpl_customer::id() . '_update_password' ?>"
                               value=""/>
                    </div>

                    <div class="form-group">
                        <label for="">New Password <?= tpl_customer::customer() ?> : </label>
                        <input type="text" class="form-control"
                               id="<?= tpl_customer::customer() . '_' . tpl_customer::password() . '_update_password' ?>"
                               name="<?= tpl_customer::customer() . '_' . tpl_customer::password() . '_update_password' ?>"/>
                    </div>

                    <div class="form-group">
                        <label for="">Retype New Password <?= tpl_customer::customer() ?> : </label>
                        <input type="text" class="form-control"
                               id="<?= tpl_customer::customer() . '_' . tpl_customer::password() . '_r_update_password' ?>"
                               name="<?= tpl_customer::customer() . '_' . tpl_customer::password() . '_r_update_password' ?>"/>
                    </div>
                    <button type="submit" class="btn btn-success" id="update" name="update">Save</button>
                </form>
                </br>
                <div class="" id="result_massages_update_password"></div>
            </div>
        </div>
    </div>
</div>

<style>
    .glyphicon-ok {

        color: green;
    }

    .glyphicon-remove {
        color: #B94A48;
    }

    tbody {
        text-align: center;
    }

    thead {
        background-color: #5CB85C;
        color: #fff;
    }

    i.form-control-feedback.glyphicon.glyphicon-ok, i.form-control-feedback.glyphicon.glyphicon-remove {
        position: relative;
        top: -25px;
        right: 11px;
        float: right;
    }
</style>