<div class="modal hide fade" id="masterModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<!-- Modal Header -->
			<div class="modal-header">
				<h6 class="modal-title" id="modal-title"></h6>
				<button type="button" class="close btn btn-danger btn-sm" data-dismiss="modal" style="height: 30px !important;
				width: 30px;
				display: block;
				padding: 0px;">&times;</button>
			</div>
			<!-- Modal body --><div>
				<div  class="modal-body"> 
					<div id="loading" style="opacity: 0.9;background: black; width: 100%;height: 111%; position: absolute;left: 0%; top: -11%;display: none;">
					<p style="    border-radius: 9px; text-align: center; color: white;font-size: 1.1em;"><strong>Processing!</strong><br />
						It will take some time depending on your internet connection.
					</p>
				<div class="spinner-border"   role="status" style="color: #ffffff;height: 4rem; width: 4rem; position: absolute;left: 40%; top: 40%;">
  				<span class="sr-only">Loading...</span>
				</div> 
				</div>

				<div id="modal-body"></div>
				</div>
			</div>
		</div>
	</div>
</div>
