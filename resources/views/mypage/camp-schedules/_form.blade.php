<div class="form-group">
    <camp-place-select-box
        :items="{{ $campPlaces }}"
        :default-name='"{{ old('camp_place_name', $campSchedule->camp_place_name) }}"'
        :default-id="'{{ old('camp_place_id', $campSchedule->camp_place_id) }}'"
    />
</div>
<div class="form-group">
    <input id="date" type="date" class="@error('date') is-invalid @enderror"
           name="date" value="{{ old('date', !empty($campSchedule->date) ? $campSchedule->date->format('Y-m-d') : '') }}">
    <label class="form-label" for="date">日付<span class="require">*</span></label>

    @error('date')
    <div class="text-error my-5">
        <strong>{{ $message }}</strong>
    </div>
    @enderror
</div>

<div class="form-group">
    <input id="number_of_stay" type="number" class="@error('number_of_stay') is-invalid @enderror"
           name="number_of_stay" value="{{ old('number_of_stay', $campSchedule->number_of_stay) }}">
    <label class="form-label" for="number_of_stay">泊数 (0の場合はデイになります)</label>
</div>

<div class="form-group">
    <input id="number_of_people" type="number" class="@error('number_of_people') is-invalid @enderror"
           name="number_of_people" value="{{ old('number_of_people', $campSchedule->number_of_people) }}">
    <label class="form-label" for="number_of_people">人数</label>
</div>

<div class="form-group">
    <textarea name="review">{{ old('review', $campSchedule->review) }}</textarea>
    <label class="form-label" for="cancel_note">口コミ</label>
    <p class="require">※ 記録・予定のステータスが「公開」の場合、<br>ここに入力された口コミ情報はキャンプ場口コミページに掲載されます <br></p>

    @error('review')
    <div class="text-error my-5">
        <strong>{{ $message }}</strong>
    </div>
    @enderror
</div>

<div class="form-group">
    <textarea name="note">{{ old('note', $campSchedule->note) }}</textarea>
    <label class="form-label" for="cancel_note">メモ</label>
    @error('note')
    <div class="text-error my-5">
        <strong>{{ $message }}</strong>
    </div>
    @enderror
</div>

<div class="form-check-group ml-10 mt-0">
    <p class="small-txt text-gray">プロフィールページに</p>
    <label class="radio-item form-label">
        <input type="radio" name="is_public_note" value="0"
                {{ old('is_public_note', $campSchedule->is_public_note) != 1 ? 'checked' : '' }}>
        <span>非表示</span>
    </label>
    <label class="radio-item form-label">
        <input type="radio" name="is_public_note" value="1"
                {{ old('is_public_note', $campSchedule->is_public_note) == 1 ? 'checked' : '' }}>
        <span>表示</span>
    </label>

    @error('is_public_note')
    <div class="text-error my-5">
        <strong>{{ $message }}</strong>
    </div>
    @enderror
</div>

<div class="form-group">
    <drop-images :name="'images[]'" :images="'{{ json_encode(old('images', $campSchedule->imagePaths)) }}'"
                :url="'/api/uploadImages'" :dir="'uploaded/camp-schedule'"></drop-images>
    <label class="form-label" for="avatar_path">画像</label>
</div>

<div class="form-check-group">
    <label class="radio-item form-label">
        <input type="radio" name="is_public" value="0"
            {{ old('is_public', (!empty($campSchedule->id) ? $campSchedule->is_public : 1)) != 1 ? 'checked' : '' }}>
        <span>非公開</span>
    </label>
    <label class="radio-item form-label">
        <input type="radio" name="is_public" value="1"
            {{ old('is_public', (!empty($campSchedule->id) ? $campSchedule->is_public : 1)) == 1 ? 'checked' : '' }}>
        <span>公開</span>
    </label>
</div>
