<div class="form-group">
    <camp-place-select-box
        :items="{{ $campPlaces }}"
        :default-name="'{{ old('camp_place_name', $campSchedule->camp_place_name) }}'"
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
    <input id="title" type="text" class="@error('title') is-invalid @enderror"
           name="title" value="{{ old('title', $campSchedule->title) }}">
    <label class="form-label" for="title">タイトル<span class="require">*</span></label>

    @error('title')
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
    <input id="url" type="text" class="@error('url') is-invalid @enderror"
           name="url" value="{{ old('url', $campSchedule->url) }}">
    <label class="form-label" for="url">URL</label>
</div>

<div class="form-group">
    <textarea name="cancel_note">{{ old('cancel_note', $campSchedule->cancel_note) }}</textarea>
    <label class="form-label" for="cancel_note">キャンセル規程</label>
</div>

<div class="form-group">
    <input id="in" type="time" class="@error('in') is-invalid @enderror"
           name="in" value="{{ old('in', $campSchedule->in) }}">
    <label class="form-label" for="in">イン</label>
</div>

<div class="form-group">
    <input id="out" type="time" class="@error('out') is-invalid @enderror"
           name="out" value="{{ old('out', $campSchedule->out) }}">
    <label class="form-label" for="out">アウト</label>
</div>

<div class="form-group">
    <input id="tel_number" type="text" class="@error('tel_number') is-invalid @enderror"
           name="tel_number" value="{{ old('tel_number', $campSchedule->tel_number) }}">
    <label class="form-label" for="tel_number">電話番号</label>
</div>

<div class="form-group">
    <drop-image v-bind:name="'images[]'" v-bind:path="'{{ old('images.0', !empty($campSchedule->images[0]) ? $campSchedule->images[0]->image_path : '') }}'"
                v-bind:url="'/api/uploadImage'" v-bind:dir="'uploaded/camp-schedule'"></drop-image>
    <label class="form-label" for="avatar_path">画像1 (アイキャッチ画像)</label>
</div>

<div class="form-group">
    <drop-image v-bind:name="'images[]'" v-bind:path="'{{ old('images.2', !empty($campSchedule->images[1]) ? $campSchedule->images[1]->image_path : '') }}'"
                v-bind:url="'/api/uploadImage'" v-bind:dir="'uploaded/camp-schedule'"></drop-image>
    <label class="form-label" for="avatar_path">画像2</label>
</div>

<div class="form-group">
    <drop-image v-bind:name="'images[]'" v-bind:path="'{{ old('images.3', !empty($campSchedule->images[2]) ? $campSchedule->images[2]->image_path : '') }}'"
                v-bind:url="'/api/uploadImage'" v-bind:dir="'uploaded/camp-schedule'"></drop-image>
    <label class="form-label" for="avatar_path">画像3</label>
</div>

<div class="form-group">
    <drop-image v-bind:name="'images[]'" v-bind:path="'{{ old('images.4', !empty($campSchedule->images[3]) ? $campSchedule->images[3]->image_path : '') }}'"
                v-bind:url="'/api/uploadImage'" v-bind:dir="'uploaded/camp-schedule'"></drop-image>
    <label class="form-label" for="avatar_path">画像4</label>
</div>

<div class="form-group">
    <drop-image v-bind:name="'images[]'" v-bind:path="'{{ old('images.5', !empty($campSchedule->images[4]) ? $campSchedule->images[4]->image_path : '') }}'"
                v-bind:url="'/api/uploadImage'" v-bind:dir="'uploaded/camp-schedule'"></drop-image>
    <label class="form-label" for="avatar_path">画像5</label>
</div>

<div class="form-check-group">
    <label class="radio-item form-label">
        <input type="radio" name="is_public" value=""
            {{ old('is_public', $campSchedule->is_public) != 1 ? 'checked' : '' }}>
        <span>非公開</span>
    </label>
    <label class="radio-item form-label">
        <input type="radio" name="is_public" value="1"
            {{ old('is_public', $campSchedule->is_public) == 1 ? 'checked' : '' }}>
        <span>公開</span>
    </label>
</div>
