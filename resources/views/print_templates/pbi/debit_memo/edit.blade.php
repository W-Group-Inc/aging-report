<div class="modal fade" id="EditDebitMemo{{ $detail->id }}" tabindex="-1" aria-labelledby="edit_debit_memoLabel" aria-hidden="true">
    <form method="POST" id="birDebitMemo" action="{{ url('edit_debit_memo_pbi/' . $detail->id) }}" autocomplete="off">
      @csrf
      <div class="modal-dialog modal-md">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="edit_debit_memoLabel">BIR Debit Memo</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
                <div class="col-md-6">
                    <label>Date:</label>
                    <input name="debit_date" class="form-control" type="date" value="{{ $detail->date }}">
                </div>
                <div class="col-md-6">
                    <label>Debit Memorandum No.</label>
                    <input name="DebitNo" class="form-control" type="number" value="{{ $detail->debit_memo_no }}">
                </div>
                <div class="col-md-12">
                    <label>To:</label>
                    <input name="Client" class="form-control" type="text" value="{{ $detail->client }}">
                </div>
                <div class="col-md-12">
                    <label>Address:</label>
                    <textarea name="ClientAddress" class="form-control" rows="3">{{ $detail->client_address }}</textarea>
                </div>
            </div>      
            <div class="col-md-12 row"><h3>Product</h3></div> 
            <div class="row">
                <div class="row" style="margin: 0 50px 0 50px">
                    <div class="mt-4">
                        <table class="table table-bordered" id="debit_descriptions{{ $detail->id }}">
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
                              @foreach ($detail->DebitMemoBody as $item)
                              <tr>
                                <input name="bodyId[]" class="form-control" type="hidden" value="{{ $item->id }}">
                                <td><input type="text" name="ListNo[]" class="form-control" value="{{ $item->ListNo }}"></td>
                                <td><input type="text" name="Quantity[]" class="form-control" value="{{ $item->Quantity }}"></td>
                                <td><input type="text" name="Unit[]" class="form-control" value="{{ $item->Unit }}"></td>
                                <td><input type="text" name="Description[]" class="form-control" value="{{ $item->description }}"></td>
                                <td><input type="text" name="UnitPrice[]" class="form-control" value="{{ $item->UnitPrice }}"></td>
                                <td><input type="text" name="Currency[]" class="form-control" value="{{ $item->Currency }}"></td>
                                <td><input type="text" name="Total[]" class="form-control" value="{{ $item->total }}"></td>
                              </tr>
                              @endforeach
                            </tbody>
                          </table> 
                          <div class="row" style="margin-top: 20px">
                            <button type="button" class="btn btn-primary" id="addRowBtn{{ $detail->id }}">Add Row</button>            
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
    document.getElementById('addRowBtn{{ $detail->id }}').addEventListener('click', function() {
        const table = document.getElementById('debit_descriptions{{ $detail->id }}').getElementsByTagName('tbody')[0];
        const newRow = table.rows[0].cloneNode(true);
        
        const inputs = newRow.getElementsByTagName('input');
        for (let input of inputs) {
            input.value = '';
        }

        table.appendChild(newRow);
    });
</script>
