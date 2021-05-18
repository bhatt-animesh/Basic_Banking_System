<table class="table table-striped table-bordered zero-configuration">
    <thead>
        <tr>
            <th>SN. No</th>
            <th>Sender Name</th>
            <th>Receiver Name</th>
            <th>Amount Transferred</th>
            <th>Date Of Transcation</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($gettransfers as $users) {
        ?>
        <tr id="dataid{{$users->id}}">
            <td>{{$users->id}}</td>
            <td>{{$users->from_user_id}}</td>
            <td>{{$users->to_user_id}}</td>
            <td>{{$users->amount_recived}} Rs</td>
            <td>{{$users->created_at}}</td>
        </tr>
        <?php
        }
        ?>
    </tbody>
</table>