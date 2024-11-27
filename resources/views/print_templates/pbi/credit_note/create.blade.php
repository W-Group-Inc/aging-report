<div class="modal fade" id="new_pbi_credit_note" tabindex="-1" aria-labelledby="new_pbi_credit_noteLabel" aria-hidden="true">
    <form method="POST" id="birCreditNote" action="{{ url('save_credit_note_pbi') }}" autocomplete="off">
      @csrf
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="new_pbi_credit_noteLabel">Credit Note</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
                <div class="col-md-6">
                    <label>Date:</label>
                    <input name="credit_date" class="form-control" type="date" value="">
                </div>
                <div class="col-md-6">
                    <label>Credit Note No.</label>
                    <input name="CreditNo" class="form-control" type="number" value="">
                </div>
                <div class="col-md-12">
                    <label>To:</label>
                    <input name="Client" class="form-control" type="text" value="">
                </div>
                <div class="col-md-12">
                    <label>Address:</label>
                    <textarea name="ClientAddress" class="form-control" rows="3"></textarea>
                </div>
            </div>      
            <div class="col-md-12 row"><h3>Product</h3></div> 
            <div class="row">
                <div class="row" style="margin: 0 50px 0 50px">
                    <div class="mt-4">
                        <table class="table table-bordered" id="credit_descriptions">
                            <thead>
                              <tr>
                                <th>List No.</th>
                                <th>Quantity</th>
                                <th>Unit</th>
                                <th>Description</th>
                                <th>Unit Price</th>
                                <th>Currency</th>
                                <th>Total</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td><input type="text" name="ListNo[]" class="form-control" value=""></td>
                                <td><input type="text" name="Quantity[]" class="form-control" value=""></td>
                                <td><input type="text" name="Unit[]" class="form-control" value=""></td>
                                <td><input type="text" name="Description[]" class="form-control" value=""></td>
                                <td><input type="text" name="UnitPrice[]" class="form-control" value=""></td>
                                <td><input type="text" name="Currency[]" class="form-control" value=""></td>
                                <td><input type="text" name="Total[]" class="form-control" value=""></td>
                              </tr>
                            </tbody>
                          </table> 
                          <div class="row" style="margin-top: 20px">
                            <button type="button" class="btn btn-primary" id="addRowBtn">Add Row</button>            
                          </div>
                      </div>  
                </div> 
            </div>   
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary">Ok</button>
          </div>
        </div>
      </div>
    </form>
</div>

<script>
    document.getElementById('addRowBtn').addEventListener('click', function() {
        const table = document.getElementById('credit_descriptions').getElementsByTagName('tbody')[0];
        const newRow = table.rows[0].cloneNode(true);
        
        const inputs = newRow.getElementsByTagName('input');
        for (let input of inputs) {
            input.value = '';
        }

        table.appendChild(newRow);
    });
</script>
