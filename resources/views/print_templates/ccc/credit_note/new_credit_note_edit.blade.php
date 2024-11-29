<div class="modal fade" id="NewCreditNoteEditCCC{{ $detail->NewCreditNote->id }}" tabindex="-1" aria-labelledby="NewCreditNoteLabel" aria-hidden="true">
    <form method="POST" id="CreditNote" action="{{ url('edit_credit_note_ccc/'. $detail->NewCreditNote->id) }}" autocomplete="off">
      @csrf
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Edit Credit Note</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
                <input name="DocEntry" class="form-control" type="hidden" value="{{ $detail->DocEntry }}">
                <div class="col-md-3">
                  <label >Number:</label>
                  <input name="CreditNoteNumber" class="form-control" type="text" value="{{ $detail->NewCreditNote->CreditNoteNumber }}">
                </div>
                <div class="col-md-3">
                    <label >Date:</label>
                    <input name="Date" class="form-control" type="date" value="{{ $detail->NewCreditNote->Date }}">
                </div>
                <div class="col-md-6">
                    <label >Sold To:</label>
                    <input name="SoldTo" class="form-control" type="text" value="{{ $detail->NewCreditNote->Client }}">
                </div>
                <div class="col-md-12">
                  <label>Reason</label>
                  <input name="SingleLabel" class="form-control" type="text" value="{{ $detail->NewCreditNote->Label2 }}">
              </div>
              <div class="col-md-12">
                <label >Currency</label>
                <select name="Currency" class="form-control">
                  <option value="USD" {{ $detail->NewCreditNote->Currency == 'USD' ? 'selected' : '' }}>USD</option>
                  <option value="EUR" {{ $detail->NewCreditNote->Currency == 'EUR' ? 'selected' : '' }}>EUR</option>
                  <option value="PHP" {{ $detail->NewCreditNote->Currency == 'PHP' ? 'selected' : '' }}>PHP</option>
                </select>
              </div>
            </div>   
            <div class="row" style="margin-top: 10px">
                <div class="table-responsive mt-4">
                    <table class="table table-bordered" id="creditNoteTable{{ $detail->NewCreditNote->id }}">
                        <thead>
                          <tr>
                            <th>SI Date</th>
                            <th>SI#</th>
                            <th>DR#</th>
                            <th>PO#</th>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Unit Price</th>
                            <th>Amount</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach (  $detail->NewCreditNote->CreditNoteBody as $body)
                          
                          <tr>
                            <input name="bodyId[]" class="form-control" type="hidden" value="{{ $body->id }}">
                            <td><input type="text" name="Label1[]" class="form-control" value="{{ $body->Label1 }}"></td>
                            <td><input type="text" name="Label2[]" class="form-control" value="{{ $body->Label2 }}"></td>
                            <td><input type="text" name="Label3[]" class="form-control" value="{{ $body->Label3 }}"></td>
                            <td><input type="text" name="Label4[]" class="form-control" value="{{ $body->Label4 }}"></td>
                            <td><input type="text" name="Label5[]" class="form-control" value="{{ $body->Label5 }}"></td>
                            <td><input type="text" name="Label6[]" class="form-control" value="{{ $body->Label6 }}"></td>
                            <td><input type="text" name="Label7[]" class="form-control" value="{{ $body->Label7 }}"></td>
                            <td><input type="text" name="Label8[]" class="form-control product-amount" value="{{ $body->Label8 }}"></td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table> 
                      <div class="col-md-6">
                        <label>Total</label>
                        <input id="ProductTotal{{ $detail->NewCreditNote->id }}" name="ProductTotal" class="form-control product-total" type="text" value="{{ $detail->NewCreditNote->Total }}" readonly>
                    </div>
                  </div>  
            </div> 
            <div class="row" style="margin-top: 20px">
              <button type="button" class="btn btn-primary" id="addRowBtn{{ $detail->NewCreditNote->id }}">Add Row</button>            
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
        function updateProductTotal(modalId) {
            const modal = document.getElementById(modalId);
            const amounts = modal.querySelectorAll('.product-amount');
            let total = 0;
            amounts.forEach(function(amount) {
                const value = parseFloat(amount.value) || 0;
                total += value;
            });

            const productTotal = modal.querySelector('#ProductTotal' + modalId.replace('NewCreditNoteEditCCC', ''));
            productTotal.value = total.toFixed(2); 
        }

        document.getElementById('addRowBtn{{ $detail->NewCreditNote->id }}').addEventListener('click', function() {
            const table = document.getElementById('creditNoteTable{{ $detail->NewCreditNote->id }}').getElementsByTagName('tbody')[0];
            const newRow = table.rows[0].cloneNode(true);
            
            const inputs = newRow.getElementsByTagName('input');
            for (let input of inputs) {
                input.value = ''; 
            }

            table.appendChild(newRow);
            updateProductTotal('NewCreditNoteEditCCC{{ $detail->NewCreditNote->id }}'); // Update total after adding a row
        });

        document.getElementById('creditNoteTable{{ $detail->NewCreditNote->id }}').addEventListener('input', function(e) {
            if (e.target.name === 'Label8[]') {
                updateProductTotal('NewCreditNoteEditCCC{{ $detail->NewCreditNote->id }}');
            }
        });

        updateProductTotal('NewCreditNoteEditCCC{{ $detail->NewCreditNote->id }}');

    </script>