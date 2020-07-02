<script>
	var OpenPayConfig = {
		setId: "<?php echo $_SESSION['Ecommerce-OpenPayId'] ?>",
		setApiKey: "<?php echo $_SESSION['Ecommerce-OpenPayPublicKey'] ?>",
		setSandboxMode: <?php echo $_SESSION['Ecommerce-OpenPaySandboxMode'] ?>,
	}
</script>