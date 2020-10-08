<?php

class FormBuilder {
	public $errors;
	public $defaults;
	protected $viewHelpers;
	protected $specialTracking = [];
	protected $lastFieldName;

	public function __construct($errors = [], $defaults = []) {
		$this->errors = $errors;
		$this->defaults = $defaults;
		$this->viewHelpers = DI::getDefault()->get('IViewHelpers');
	}

	public function inputField($name, $label = null, $type = 'text', $placeholder = '') {
		?>
		<div class="form-group <?php echo $this->getFormGroupClass() ?>">
			<label for="<?php echo $name ?>"><?php echo $label ?? $name ?></label>
			<input type="<?php echo $type ?>" class="form-control <?php echo !empty($this->errors[$name]) ? 'is-invalid' : '' ?>" id="<?php echo $name ?>" name="<?php echo $name ?>" placeholder="<?php echo $this->escapeHtml($placeholder) ?>" value="<?php echo ($type != 'password' && isset($this->defaults[$name])) ? $this->escapeHtml($this->defaults[$name]) : '' ?>">
			<?php if (!empty($this->errors[$name])) : ?>
				<div class="invalid-feedback">
					<?php echo $this->errors[$name] ?>
				</div>
			<?php endif; ?>
		</div>
		<?php
	}

	public function checkbox($name, $label = null, $value = 1, $inline = true) {
		?>
		<div class="form-check <?php echo $inline ? 'form-check-inline' : '' ?>">
			<input class="form-check-input <?php echo !empty($this->errors[$name]) ? 'is-invalid' : '' ?>" type="checkbox" id="<?php echo $name ?>" name="<?php echo $name ?>" value="<?php echo $this->escapeHtml($value) ?>" <?php echo (isset($this->defaults[$name]) && $this->defaults[$name] == $value) ? 'checked' : '' ?>>
			<label class="form-check-label" for="<?php echo $name ?>"><?php echo $label ?? $name ?></label>
			<?php if (!empty($this->errors[$name])) : ?>
				<div class="invalid-feedback">
					<?php echo $this->errors[$name] ?>
				</div>
			<?php endif; ?>
		</div>
		<?php
	}

	public function radio($name, $value = 1, $label = null, $inline = true) {
		$this->lastFieldName = $name;
		?>
		<div class="form-group <?php echo $this->getFormGroupClass() ?>">
			<div class="form-check <?php echo $inline ? 'form-check-inline' : '' ?>">
				<input class="form-check-input <?php echo !empty($this->errors[$name]) ? 'is-invalid' : '' ?>" type="radio" id="<?php echo $name ?>" name="<?php echo $name ?>" value="<?php echo $this->escapeHtml($value) ?>" <?php echo (isset($this->defaults[$name]) && $this->defaults[$name] == $value) ? 'checked' : '' ?>>
				<label class="form-check-label" for="<?php echo $name ?>"><?php echo $label ?? $name ?></label>
			</div>
		</div>
		<?php
	}

	public function formGroup($callback) {
		?>
		<div class="form-group <?php echo $this->getFormGroupClass() ?>">
			<?php $callback($this) ?>
		</div>
		<?php
	}

	public function checkboxGroup($label, $callback) {
		?>
		<label class="d-block"><?php echo $label ?></label>
		<div class="form-group checkbox-group <?php echo $this->getFormGroupClass() ?>">
			<?php $callback($this) ?>
		</div>
		<?php
	}

	public function radioGroup($callback) {
		?>
		<div class="form-group radio-group <?php echo $this->getFormGroupClass() ?>">
			<?php $callback($this) ?>
			<?php if (!empty($this->errors[$this->lastFieldName])) : ?>
				<div class="invalid-feedback">
					<?php echo $this->errors[$this->lastFieldName] ?>
				</div>
			<?php endif; ?>
		</div>
		<?php
	}

	public function row($sizes, $callback) {
		$this->specialTracking[] = [
			'type' => 'row',
			'col' => 0,
			'sizes' => $sizes
		];

		?>
		<div class="form-row">
			<?php $callback($this) ?>
		</div>
		<?php
	}

	public function button($label, $type = 'submit', $style = 'primary') {
		?>
		<button type="<?php echo $type ?>" class="btn btn-<?php echo $style ?>"><?php echo $label ?></button>
		<?php
	}

	public function getError($name) {
		if (!empty($this->errors[$name])) : ?>
		<div class="invalid-feedback">
			<?php echo $this->errors[$name] ?>
		</div>
		<?php endif;
	}

	protected function getFormGroupClass() {
		if ($len = count($this->specialTracking)) {
			$level = &$this->specialTracking[$len - 1];
			switch ($level['type']) {
				case 'row':
					return 'col-md-' . $level['sizes'][$level['col']++];
			}
		}
	}

	protected function escapeHtml($input) {
		return $this->viewHelpers->escapeHtml($input);
	}
}