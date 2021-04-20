<template>
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title">{{classTitle}}: Create a feedback session</h5>
			<button class="close" data-dismiss="modal">&times;</button>
		</div>
		<div class="modal-body">
			<div class="collapse show" id="formCollapse" ref="formCollapse">
				<form method="POST" id="feedback-form" v-on:submit="submitForm($event)">
					<div class="form-row">
						<div class="form-group col-md-12 col-lg-4">
							<label for="feedback-title">Feedback Title</label>
							<input type="text" class="form-control" v-bind:class="errors.title ? 'is-invalid' : ''" id="feedback-title" name="feedbacktitle" placeholder="Midterm Feedback" v-model="title" required>
						</div>
						<div class="form-group col-md-6 col-lg-4">
							<label for="feedbackstart">Start Time</label>
							<input type="time" class="form-control" v-bind:class="errors.start ? 'is-invalid' : ''" id="feedbackstart" name="feedbackstart" v-model="start" required>
						</div>
						<div class="form-group col-md-6 col-lg-4">
							<label for="feedbackend">End Time</label>
							<input type="time" class="form-control" v-bind:class="errors.end ? 'is-invalid' : ''" id="feedbackend" name="feedbackend" v-bind:min="start" v-model="end" required>
						</div>
					</div>

					<div class="card mb-3">
						<div class="card-header">
							Fields for this feedback session:
						</div>
						<div class="card-body">
							<transition-group
								tag="div"
								v-bind:css="false"
								v-on:enter="animEnter"
								v-on:leave="animLeave"
							>
								<div v-for="(field, ndx) in fields" class="form-row field-row" v-bind:class="'field-row-' + field.type.toLowerCase().replace('_', '-')" v-bind:key="field.id" v-bind:class="ndx % 2 == 1 ? 'odd' : 'even'">
									<div class="form-group col-lg-5 col-md-6">
										<label class="question-label" v-bind:for="'title' + ndx">Question {{ ndx + 1 }} Label</label>
										<input type="text" class="form-control field-name" v-bind:id="'title' + ndx" v-on:placeholder="'Question #' + (ndx + 1) +' Title'" v-model="field.label" required>
									</div>
									<div class="form-group col-lg-5 col-md-6 field-options">
										<label>Response Section</label>
										<component
											v-bind:is="getFieldComponent(field.type)"
											v-bind:type="field.type"
											v-bind:options="field.options"
											v-on:add-option="addOption(field)"
											v-on:remove-option="removeOption(field, $event)"
											v-on:update-option="updateOption(field, $event)">
										</component>
									</div>
									<div class="form-group col-lg-2 col-md-12 border-left p-3 field-meta">
										<div class="form-check">
											<input class="form-check-input" type="checkbox" v-bind:id="'optional' + ndx" v-model="field.optional">
											<label class="form-check-label" v-bind:for="'optional' + ndx">Optional</label>
										</div>
										<button type="button" class="btn btn-danger w-100 btn-delete" v-on:click="removeField(ndx)"><i class="fas fa-trash"></i> Field</button>
									</div>
								</div>
							</transition-group>

							<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Add Field
							</button>
							<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
								<a v-for="(label, type) in fieldTypes" :key="type" class="dropdown-item" href="javascript:void(0)" v-on:click="addField(type)">{{label}}</a>
							</div>
						</div>
					</div>

					<button type="submit" class="btn btn-primary btn-create float-right" v-bind:disabled="!formReady || processing">
						Create
						<i v-if="processing" class="fas fa-cog fa-spin"></i>
					</button>

					<button type="button" class="btn btn-info btn-help float-right mr-2" data-start-tour="FeedbackForm Tour">
						Help
					</button>
				</form>
			</div>
			<div class="collapse" id="successCollapse" ref="successCollapse">
				<div class="alert alert-success text-center mb-5" role="alert">
					Feedback session created successfully!
				</div>

				<button type="button" class="btn btn-primary float-right" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</template>

<script>
	export default {
		data: function() {
			return {
				title: '',
				start: '00:00',
				end: '00:00',
				classTitle: window.feedbackFormDefaults.classTitle,
				classId: window.feedbackFormDefaults.classId,
				
				fieldTypes: {
					SHORT_TEXT: 'Short Text',
					LONG_TEXT: 'Long Text',
					RADIO_GROUP: 'Radio Group',
					CHECKBOX_GROUP: 'Checkbox Group',
					RATING: 'Rating'
				},
				fields: [],
				errors: {},

				processing: false,
				submitted: false,
				nextFieldId: 1
			};
		},

		mounted: function() {
			window.feedbackFormApp = this;

			$([this.$refs.formCollapse, this.$refs.successCollapse]).collapse({
				toggle: false
			});

			let that = this;
			$('#feedback-app').on('hidden.bs.modal', function() {
				that.reset();
			});
			$('#feedback-app').on('shown.bs.modal', function() {
				let tour = TourInstance.getInstance('FeedbackForm Tour');
				if (tour && tour.firstTime) {
					setTimeout(() => {
						tour.start();
					}, 500);
				}
			});

			this.reset();
		},

		computed: {
			formReady: function() {
				if (!this.title.trim() || !this.start || !this.end || this.start == this.end || !this.fields.length) {
					return false;
				}

				return this.fields.reduce(function(carry, field) {
					if (!carry || !field.label) {
						return false;
					}

					if (field.options) {
						if (field.options.length < 2) {
							return false;
						}

						for (let i in field.options) {
							if (!field.options[i].trim()) {
								return false;
							}
						}
					}

					return carry;
				}, true);
			}
		},

		methods: {
			addField: function(type) {
				let field = {
					id: this.nextFieldId++,
					type: type,
					label: '',
					options: undefined,
					optional: false
				};

				if (type == 'RADIO_GROUP' || type == 'CHECKBOX_GROUP') {
					field.options = ['', ''];
				}

				this.fields.push(field);
			},

			removeField: function(ndx) {
				this.fields.splice(ndx, 1);
			},

			getFieldComponent: function(type) {
				switch (type) {
					case 'RADIO_GROUP':
					case 'CHECKBOX_GROUP':
						return 'field-type-input-group';
					default:
						return `field-type-${type.toLowerCase().replace(/_/g, '-')}`;
				}
			},

			addOption: function(field) {
				if (!field.options) {
					field.options = [];
				}

				field.options.push('');
			},

			removeOption: function(field, ndx) {
				field.options.splice(ndx, 1);
			},

			updateOption: function(field, {ndx, val}) {
				this.$set(field.options, ndx, val);
			},

			reset: function() {
				this.title = '';
				this.start = '00:00';
				this.end = '00:00';
				this.fields = [];
				this.submitted = false;
			},

			submitForm: function(e) {
				e.preventDefault();
				if (!this.formReady) {
					return;
				}

				let data = {
					title: this.title,
					start: this.start,
					end: this.end,
					fields: JSON.stringify(this.fields.map(f => ({
						type: f.type,
						label: f.label,
						options: f.options,
						optional: f.optional
					})))
				};
				
				var that = this;

				this.processing = true;
				$.post(`${BASEURL}Feedback/FeedbackForm/${this.classId}`, data, function(resp) {
					if (resp.errors) {
						that.$set(that, 'errors', resp.errors);
					}
					else if (resp.success) {
						// Yay!
						that.submitted = true;
					}
				}).always(function() {
					that.processing = false;
				});
			},

			animEnter: function(el, done) {
				let $el = $(el),
					realHeight = $(el).height();
				$el.height(0).addClass('transition-250');

				this.$nextTick(function() {
					$el.height(realHeight);
					setTimeout(function() {
						$el.height('auto');
						done();
					}, 250);
				});
			},

			animLeave: function(el, done) {
				let $el = $(el);
				$el.height($el.height()).addClass('transition-250');

				this.$nextTick(function() {
					$el.height(0);
					setTimeout(done, 250);
				});
			},

			setClass: function(classId, classTitle) {
				this.classId = classId;
				this.classTitle = classTitle;
			}
		},

		watch: {
			start: function() {
				if (this.start.localeCompare(this.end) > 0) {
					this.end = this.start;
				}
			},

			submitted: function() {
				$(this.$refs.formCollapse).collapse(this.submitted ? 'hide': 'show');
				$(this.$refs.successCollapse).collapse(this.submitted ? 'show': 'hide');
			}
		}
	}
</script>

<style scoped>
	.field-row.odd {
		background-color: #f0f0f0;
	}

	.field-row {
		overflow: hidden;
	}
</style>