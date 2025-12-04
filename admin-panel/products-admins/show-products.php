<?php require_once "../layouts/header.php"; ?>

<?php
// যদি অ্যাডমিন লগ ইন না থাকে
if (!isset($_SESSION['admin_name'])) {
  header("Location: " . url . "/index.php");
  exit();
}

// ডেটাবেস থেকে সকল প্রোডাক্ট ফেচ করুন
$product_query = "SELECT * FROM products";
$query_result = mysqli_query($conn, $product_query) or die("Query Unsuccessful");

?>

<div class="container-fluid">
  <div class="row">
    <div class="col">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title mb-4 d-inline">Foods</h5>
          <a href="create-products.php" class="btn btn-primary mb-4 text-center float-right">Add New Product</a>
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th class="text-center">Id</th>
                  <th class="text-center">name</th>
                  <th class="text-center">image</th>
                  <th class="text-center">price</th>
                  <th class="text-center">type</th>
                  <th class="text-center">delete</th>
                </tr>
              </thead>
              <tbody>
                <?php
                if (mysqli_num_rows($query_result) > 0) {
                  while ($product = mysqli_fetch_assoc($query_result)) {
                ?>
                    <tr>
                      <td class="text-center"><?php echo $product['id']; ?></td>
                      <td class="text-center"><?php echo $product['name']; ?></td>
                      <td class="text-center"><img src="../../images/<?php echo $product['image']; ?>" height="60px"
                          width="60px"></td>
                      <td class="text-center">$<?php echo $product['price']; ?></td>
                      <td class="text-center"><?php echo $product['type']; ?></td>
                      <td class="text-center">
                        <button type="button" class="btn btn-danger text-center delete-btn" data-bs-toggle="modal"
                          data-bs-target="#confirmDeleteModal" data-product-id="<?php echo $product['id']; ?>">
                          Delete
                        </button>
                      </td>
                    </tr>
                <?php }
                } ?>

              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Deletion</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this product? This action cannot be undone.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <a id="deleteProductLink" href="#" class="btn btn-danger">Delete</a>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>


<script>
    const confirmDeleteModal = document.getElementById('confirmDeleteModal');
    const deleteProductLink = document.getElementById('deleteProductLink');
    const baseUrl = 'delete-product.php?id='; // আপনার ডিলিট ফাইলের পাথ

    // Bootstrap modal ইভেন্ট লিসেনার
    confirmDeleteModal.addEventListener('show.bs.modal', function (event) {
        
        // যে বাটনটি ক্লিক হয়েছে, সেটিকে ধরুন
        const button = event.relatedTarget;
        
        // data-product-id অ্যাট্রিবিউট থেকে প্রোডাক্ট আইডি নিন
        const productId = button.getAttribute('data-product-id');
        
        // মডালের ডিলিট বাটনের href অ্যাট্রিবিউট আপডেট করুন
        deleteProductLink.href = baseUrl + productId;
    });
</script>

</body>

</html>