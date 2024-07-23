<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Record Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            width: 100%;
        }
        .pane {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        .form-group {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }
        label {
            width: 150px;
            font-weight: bold;
        }
        input[type="text"], select, .number {
            flex: 1;
            padding: 8px;
            margin-left: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            width: 80%;
        }
        input[type="text"]:disabled, select:disabled {
            background-color: #e9ecef;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            border: none;
            border-radius: 4px;
            color: white;
            font-size: 16px;
            cursor: pointer;
            margin-top: 10px;
        }
        button:hover {
            background-color: #0056b3;
        }
        .errors, .success {
            padding: 10px;
            border-radius: 4px;
            margin-top: 20px;
        }
        .errors {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        .errors p {
            margin: 0;
        }
        .success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .form-row {
            display: flex;
            justify-content: space-between;
            gap: 10px;
        }
    </style>
    <script>
        function calculateBoxes() {
            var qty = parseFloat(document.getElementsByName('QUANTITY')[0].value);
            var pcsInBox = parseFloat(document.getElementsByName('ALCOHOL_PCS')[0].value);
            var boxesDisplay = document.getElementsByName('ALCOHOL_CASES')[0];
            var boxesHidden = document.getElementsByName('ALCOHOL_CASES_HIDDEN')[0];

            if (!isNaN(qty) && !isNaN(pcsInBox) && pcsInBox != 0) {
                var calculatedBoxes = (qty / pcsInBox).toFixed(2);
                boxesDisplay.value = calculatedBoxes;
                boxesHidden.value = calculatedBoxes;
            } else {
                boxesDisplay.value = 0;
                boxesHidden.value = 0;
            }
        }

        window.onload = function() {
            document.getElementsByName('QUANTITY')[0].addEventListener('input', calculateBoxes);
            document.getElementsByName('ALCOHOL_PCS')[0].addEventListener('input', calculateBoxes);
            calculateBoxes();
        }
    </script>
</head>
<body>
    <form action="{{ route('record.update', $record->REQUEST_ID) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="pane">
            <div class="form-row">
                <div class="form-group">
                    <label>Request Nr.:</label>
                    <input type="text" value="{{ $record->REQUEST_ID }}" disabled>
                </div>
                <div class="form-group">
                    <label>To:</label>
                    <input type="text" value="{{ $record->TO_TYPE }}" disabled>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>From:</label>
                    <input type="text" value="{{ $record->FROM_TYPE }}" disabled>
                </div>
                <div class="form-group">
                    <label>Cargo:</label>
                    <input type="text" value="{{ $record->CARGO_ID }}" disabled>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Units:</label>
                    <input type="text" value="{{ $record->units }}" disabled>
                </div>
                <div class="form-group">
                    <label>Customs status:</label>
                    <input type="text" value="{{ $record->CUSTOMS_STATUS }}" disabled>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Weight:</label>
                    <input type="text" value="{{ $record->WEIGHT }}" disabled>
                </div>
                <div class="form-group">
                    <label>QTY:</label>
                    <input type="text" name="QUANTITY" value="{{ $record->QUANTITY }}" disabled>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Customs Dekl. Nr:</label>
                    <input type="text" value="{{ $record->customs_dekl_nr }}" disabled>
                </div>
                <div class="form-group">
                    <label>Remarks:</label>
                    <input type="text" value="{{ $record->REMARKS }}" disabled>
                </div>
            </div>
        </div>
        <div class="pane">
            <div class="form-row">
                <div class="form-group">
                    <label>Alcohol Name:</label>
                    <input type="text" name="ALCOHOL_NAME" value="{{ $record->ALCOHOL_NAME }}">
                </div>
                <div class="form-group">
                    <label>HS Code:</label>
                    <input type="text" name="CUSTOMS_CODE" value="{{ $record->CUSTOMS_CODE }}">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Packing type:</label>
                    <select name="ALCOHOL_PACKING">
                        <option class="b" value="Option 1" @if($record->ALCOHOL_PACKING == 'Option 1') selected @endif>Option 1</option>
                        <option class="b" value="Option 2" @if($record->ALCOHOL_PACKING == 'Option 2') selected @endif>Option 2</option>
                        <option class="b" value="Option 3" @if($record->ALCOHOL_PACKING == 'Option 3') selected @endif>Option 3</option>
                        <option class="b" value="Option 4" @if($record->ALCOHOL_PACKING == 'Option 4') selected @endif>Option 4</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Alc. strength (%):</label>
                    <input type="text" name="ALCOHOL_STRENGTH" value="{{ $record->ALCOHOL_STRENGTH }}">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Volume:</label>
                    <input class="number" type="number" name="ALCOHOL_VOLUME" value="{{ $record->ALCOHOL_VOLUME }}">
                </div>
                <div class="form-group">
                    <label>PCS in box:</label>
                    <input class="number" type="number" name="ALCOHOL_PCS" value="{{ $record->ALCOHOL_PCS }}">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Boxes:</label>
                    <input type="text" name="ALCOHOL_CASES" value="{{ $record->ALCOHOL_CASES }}" disabled>
                    <input type="hidden" name="ALCOHOL_CASES_HIDDEN" value="{{ $record->ALCOHOL_CASES }}">
                </div>
                <div class="form-group">
                    <label>Alcohol comments:</label>
                    <input type="text" name="ALCOHOL_COMMENT" value="{{ $record->ALCOHOL_COMMENT }}">
                </div>
            </div>
        </div>

        <button type="submit">Update</button>
    </form>

    @if ($errors->any())
        <div class="errors">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif
</body>
</html>
