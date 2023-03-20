
<!-- DataTales Example -->
<div class="table-responsive">
    <table class="table table-bordered" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th><?= lang('Tables.Th.ConditionName') ?></th>
                <th><?= lang('Tables.Th.ConditionValue') ?></th>
                <th></th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th><?= lang('Tables.Th.ConditionName') ?></th>
                <th><?= lang('Tables.Th.ConditionValue') ?></th>
                <th></th>
            </tr>
        </tfoot>
        <tbody>
            <?php foreach ($item->conditions as $item) : ?>
                <tr>
                    <td><?= $item->field_name ?></td>
                    <td><?= $item->field_value ?></td>
                    <td><?= $item->delete_link ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>