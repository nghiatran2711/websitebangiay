<?php
ini_set("display_errors","0");
$result = mysqli_query($conn, 'select count(idSanPham) as total from sanpham');
$row = mysqli_fetch_assoc($result);
$total_records = $row['total'];
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;
$limit = 10;
$total_page = ceil($total_records / $limit);
 
        // Giới hạn current_page trong khoảng 1 đến total_page
        if ($current_page > $total_page){
            $current_page = $total_page;
        }
        else if ($current_page < 1){
            $current_page = 1;
        }
 
        // Tìm Start
$start = ($current_page - 1) * $limit;
$sql_lietkesp = "select * from sanpham,nhasx,loaisanpham where loaisanpham.idLoaiSanPham=sanpham.idLoaiSanPham and nhasx.idNSX=sanpham.idNSX order by sanpham.idSanPham desc limit $start, $limit";
$row_lietkesp = mysqli_query($conn, $sql_lietkesp);
?>
<div class="table-agile-info">
  	<div class="panel panel-default">
	    <div class="panel-heading">
	      Sản phẩm
	    </div>
	    <div class="table-responsive">
	      <table class="table table-striped b-t b-light">
	        <thead>
	          <tr>
	            <th>Số thứ tự</th>
	            <th>ID Sản phẩm</th>
	            <th>Tên sản phẩm</th>
	            <th>Hình ảnh</th>
	            <th>ID Nhà sản xuất</th>
	            <th>ID Loại sản phẩm</th>
	            <th>Số Lượng</th>
	            <th>Giá</th>
	            <th style="width:100px;">Thao tác</th>
	          </tr>
	        </thead>
	        <?php
	        $i = 1;
	        while ($dong = mysqli_fetch_array($row_lietkesp)) {
	            ?>
	        <tbody>
	          <tr>
	            <td><?php echo $i; ?></td>
	            <td><span class="text-ellipsis"><?php echo $dong['idSanPham'] ?></span></td>
	            <td><span class="text-ellipsis"><?php echo $dong['tenSanPham'] ?></span></td> 
	          	<td><center><img src="modules/sanpham/uploads/<?php echo $dong['hinhAnh'] ?>" width="80px" height="80px" /></center></td>
	          	<td><span class="text-ellipsis"><?php echo $dong['idNSX'] ?></span></td>
	          	<td><span class="text-ellipsis"><?php echo $dong['idLoaiSanPham'] ?></span></td>
	          	<td><span class="text-ellipsis"><?php echo $dong['soLuong'] ?></span></td>
	          	<td><span class="text-ellipsis"><?php echo $dong['Gia'] ?></span></td>
	            <td>
	              <a href="index.php?quanly=sanpham&ac=sua&id=<?php echo $dong['idSanPham'] ?>" class="active" ui-toggle-class=""><i class="fa fa-pencil-square-o"></i></a>
	              <a href="modules/sanpham/xoa.php?id=<?php echo $dong['idSanPham'] ?>" class="active" ui-toggle-class=""> <i class="fa fa-trash-o"></i></a>
	            </td>
	          </tr>
	        </tbody>
	        <?php
	            $i++;
	        }
	        ?>
	      </table>
	    </div>
	    <footer class="panel-footer">
		    <div class="row">
			    <div class="col-sm-7 text-right text-center-xs">
				      <ul class="pagination pagination-sm m-t-none m-b-none">
				        <?php
				        if ($current_page > 1 && $total_page > 1){
				            echo'<li><a href="index.php?quanly=sanpham&ac=lietke&page='.($current_page-1).'"><i class="fa fa-chevron-left"></i></a></li>';
				        }
				        for ($i = 1; $i <= $total_page; $i++){
				            if ($i == $current_page){
				                echo '<li><a href="">'.$i.'</a></li> ';
				            }else{
				                echo '<li><a href="index.php?quanly=sanpham&ac=lietke&page='.$i.'">'.$i.'</a></li>';
				            }
				        }
				        if ($current_page < $total_page && $total_page > 1){
				            echo '<li class="page-item"><a class="page-link" href="index.php?quanly=sanpham&ac=lietke&page='.($current_page+1).'"><i class="fa fa-chevron-right"></i></a></li>';
				        }
				        ?>
				    </ul>
				</div>
			</div>
		</footer>
  	</div>
</div>