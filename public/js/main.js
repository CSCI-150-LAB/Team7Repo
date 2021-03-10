$(function() {

	$.fn.popover.Constructor.Default.whiteList['button'] = []
	for (let i in $.fn.popover.Constructor.Default.whiteList) {
		$.fn.popover.Constructor.Default.whiteList[i].push(/^data-[\w-]*$/i);
	}

	$(document).on('submit', '.instructor-search', function(e) {
		e.preventDefault();
		location.href = $(this).attr('action') + '/' + $('#search-txt').val();
	});

	function addRatingFieldClasses(parent, score) {
		for (let i = 1; i <= 5; i++) {
			parent[i <= score ? 'addClass' : 'removeClass'](`score-${i}`);
		}
	}

	$(document).on('mouseleave', '.rating-field', function() {
		let parent = $(this),
			score = parent.find('input').val() || 0;

		addRatingFieldClasses(parent, score);
	});

	$(document).on('mouseenter', '.rating-field .fa-star', function() {
		addRatingFieldClasses($(this).parent(), $(this).index());
	});

	$(document).on('click', '.rating-field .fa-star', function() {
		$(this).parent().find('input').val($(this).index());
	});

	$('.rating-field').trigger('mouseleave');

	$(document).on('click', '[data-start-tour]', function() {
		let tourName = $(this).data('start-tour'),
			inst = TourInstance.instances.find(i => i.name == tourName || i.options.name == tourName);

		if (!inst.running) {
			inst.start();
		}
	});

	setTimeout(function() {
		TourInstance.instances
			.filter(i => i.trigger)
			.forEach(i => {
				let shouldStart = false;
	
				if (typeof i.trigger == 'string') {
					shouldStart = i.trigger == TourInstance.currentPath;
				}
				else if (typeof i.trigger == 'function') {
					shouldStart = i.trigger.call(i, TourInstance.currentPath);
				}
				else if (i.trigger instanceof RegExp) {
					shouldStart = i.trigger.test(TourInstance.currentPath);
				}
	
				if (shouldStart && i.firstTime) {
					i.start();
				}
			});
	}, 1000);

});

class TourInstance {
	trigger = false;
	name = null;
	options = null;
	running = false;

	get cleanName() {
		return this.options.name;
	}

	get steps() {
		return this.options.steps;
	}

	get firstTime() {
		let data = JSON.parse(localStorage.getItem('tour-has-run') || '{}');
		return !data[this.cleanName];
	}

	set firstTime(v) {
		let data = JSON.parse(localStorage.getItem('tour-has-run') || '{}');
		data[this.cleanName] = !v;
		localStorage.setItem('tour-has-run', JSON.stringify(data));
	}

	constructor(name, options = {}) {
		TourInstance.instances.push(this);

		options = Object.assign(
			{name: `tour-${Math.random() * Number.MAX_SAFE_INTEGER}`},
			TourInstance.defaultOptions,
			options
		);

		this.name = name;
		options.name = name.toLowerCase().replace(/[^\w_-]+/g, '-');

		if (typeof options.template == 'function') {
			options.template = options.template.bind(this);
		}

		let onShown = options.onShown;
		options.onShown = (tour) => {
			this.running = true;
			if (onShown) {
				onShown(tour);
			}
		};

		let onEnd = options.onEnd;
		options.onEnd = (tour) => {
			this.running = false;
			this.firstTime = false;
			if (onEnd) {
				onEnd(tour);
			}
		};

		if (options.onShown) {
			options
		}

		this.options = options;
	}

	addPageLoadTrigger(condition) {
		this.trigger = condition;
	}

	addStep(options) {
		let newId = this.steps.length,
			lastId = newId - 1;

		if (!options.hasOwnProperty('prev')) {
			options.prev = lastId;
		}
		this.steps.push(options);

		if (this.steps[lastId] && !this.steps[lastId].hasOwnProperty('next')) {
			this.steps[lastId].next = newId;
		}
	}

	start() {
		this.tour = new Tour(this.options);
		this.tour.init()
		this.tour.restart();
	}

	static instances = [];
	static currentPath = '/' + `${location.protocol}//${location.hostname}${location.pathname}`.substr(BASEURL.length);
	static defaultOptions = {
		container: "body",
		smartPlacement: true,
		backdrop: true,
		backdropPadding: 5,
		storage: false,
		template: function(i, step) { return `
			<div class="popover" role="tooltip">
				<div class="arrow"></div>
				<h3 class="popover-header" data-progress="${i + 1} / ${this.steps.length}"></h3>
				<div class="popover-body"></div>
				<div class="popover-navigation">
					<div class="btn-group">
						<button class="btn btn-sm btn-secondary" data-role="prev">&laquo; Prev</button>
						<button class="btn btn-sm btn-secondary" data-role="next">Next &raquo;</button>
						<button class="btn btn-sm btn-secondary" data-role="pause-resume" data-pause-text="Pause" data-resume-text="Resume">Pause</button>
					</div>
					<button class="btn btn-sm btn-secondary" data-role="end">End tour</button>
				</div>
			</div>
		`},
		steps: []
	};
}