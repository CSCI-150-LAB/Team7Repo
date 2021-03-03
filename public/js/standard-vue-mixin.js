// @ts-ignore
window.VueMixin = {
	methods: {
		baseUrl(url) {
			// @ts-ignore
			return window.BASEURL + (url || '').replace(/^\//, '');
		},

		publicUrl(url) {
			return this.baseUrl() + 'public/' + (url || '').replace(/^\//, '');
		},

		ajax({ url, method, type, data }) {
			return new Promise((resolve, reject) => {
				// @ts-ignore
				$.ajax({
					method: method || 'get',
					url,
					data,
					dataType: type,

					success: function(resp) {
						resolve(resp);
					},
					error: function(jqXHR) {
						reject(jqXHR);
					}
				})
			});
		}
	}
};