<div class="form-group">
    <label for="tran_desc">Transaction Description</label>
    <input type="text" class="form-control" name="tran_desc" id="tran_desc">
</div>

<div class="form-group">
    <label for="section">Section</label>
    <select name="section" id="section" class="form-control" required>
        @foreach($section as $item)
        <option value="{{ $item->id }}">{{ $item->section_desc }}</option>
        @endforeach
    </select>
</div>