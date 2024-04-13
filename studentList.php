<?php
    include 'includes/administratorHeader.php';
?>

<?php
    $conn = new mysqli('localhost','root','', 'dbabellanaf2');
    $query = "SELECT * FROM tbluseraccount";
    $result = $conn->query($query);
?>

<style>
    table, th, td {
      border: 1px solid;
    }

    td {
      text-align: center;
    }

    tr:hover {
        background-color: #A24857;
    }
</style>    

<div class = "userlist-container">
    <table id="tblUserAccounts" class="table
        table-striped table-bordered table-sm" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Account Id</th>
                <th>Email Address</th>
                <th>Username</th>
                <th>Password</th>
                <th>User Type</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
                while ($row = $result->fetch_assoc()):
            ?>
            <tr>
                <td><?php echo $row['acctid'] ?> </td>
                <td><?php echo $row['emailadd'] ?> </td>
                <td><?php echo $row['username'] ?> </td>
                <td><?php echo $row['password'] ?> </td>
                <td><?php echo $row['usertype'] ?> </td>
                <td>
                    <a href = "">VIEW</a>
                    <a href = "">DELETE</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>