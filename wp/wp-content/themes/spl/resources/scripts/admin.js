// admin.js — WP Admin enhancements
import '../styles/admin.scss';

const run = () => {
	// ── Disable "Send user notification" on Create User ──

	const sendNotification = document.querySelector('#createuser #send_user_notification');
	if (sendNotification) {
		sendNotification.checked = false;
		sendNotification.disabled = true;
	}

	// ── Hide editor for specific page templates ──

	const HIDDEN_EDITOR_TEMPLATES = new Set(['templates/template-page-home.php']);
	const selectedTemplate = document.getElementById('page_template');
	const editorWrapper = document.getElementById('postdivrich');

	if (selectedTemplate && editorWrapper) {
		const toggleEditor = () => {
			const shouldHide = HIDDEN_EDITOR_TEMPLATES.has(selectedTemplate.value);
			editorWrapper.style.display = shouldHide ? 'none' : '';

			if (!shouldHide) {
				setTimeout(() => window.dispatchEvent(new Event('resize')), 10);
			}
		};

		toggleEditor();
		selectedTemplate.addEventListener('change', toggleEditor);
	}

	// ── Post title required ──

	const postTitle = document.querySelector('input[name="post_title"]');
	if (postTitle) {
		postTitle.required = true;
	}

	// ── Delegated click handlers (single listener) ──

	document.addEventListener('click', (e) => {
		// Notice dismiss with fade out
		const dismissBtn = e.target.closest('.notice-dismiss');
		if (dismissBtn) {
			const notice = dismissBtn.closest('.notice.is-dismissible');
			if (notice) {
				notice.style.transition = 'opacity .5s ease';
				notice.style.opacity = '0';
				setTimeout(() => notice.remove(), 500);
			}
			return;
		}

		// Trash action confirmation
		const trashLink = e.target.closest('a[href*="action=trash"]');
		if (trashLink) {
			if (!confirm('Are you sure you want to move this post to the trash?')) {
				e.preventDefault();
			}
		}
	});

	// ── jQuery-dependent WP Admin integration ──
	if (window.jQuery) {
		jQuery(() => {
			//
		});
	}

	// ── ACF Image Modal Fallback ──
	document.addEventListener(
		'click',
		(e) => {
			const addBtn = e.target.closest(
				'.acf-field-image [data-name="add"], .acf-field-image .acf-image-uploader a.button, .acf-image-uploader [data-name="add"]'
			);
			if (addBtn && typeof window.wp !== 'undefined' && typeof window.wp.media === 'function') {
				e.preventDefault();
				e.stopImmediatePropagation();

				const $btn = window.jQuery ? window.jQuery(addBtn) : null;
				const uploader = addBtn.closest('.acf-image-uploader');
				const input = uploader ? uploader.querySelector('input[type="hidden"]') : null;
				const img = uploader ? uploader.querySelector('img[data-name="image"]') : null;

				const frame = window.wp.media({
					title: 'Chọn hoặc tải ảnh lên',
					button: { text: 'Sử dụng ảnh này' },
					multiple: false,
					library: { type: 'image' },
				});

				frame.on('select', () => {
					const attachment = frame.state().get('selection').first().toJSON();
					if (input) {
						input.value = attachment.id;
						if (window.jQuery) {
							window.jQuery(input).trigger('change');
						}
					}

					if (img) {
						img.src = attachment.url;
						img.style.display = '';
					} else if (uploader) {
						const view = uploader.querySelector('.view');
						if (view) {
							view.innerHTML = `<img data-name="image" src="${attachment.url}" alt="" style="max-width:100%;height:auto;" />`;
						}
					}
					if (uploader) {
						uploader.classList.add('has-value');
					}

					if (typeof window.acf !== 'undefined' && uploader) {
						const field = window.acf.getField(uploader.closest('.acf-field'));
						if (field) {
							field.val(attachment.id);
						}
					}
				});

				frame.open();
			}

			// Remove handler
			const removeBtn = e.target.closest(
				'.acf-field-image [data-name="remove"], .acf-image-uploader [data-name="remove"]'
			);
			if (removeBtn) {
				e.preventDefault();
				e.stopImmediatePropagation();

				const uploader = removeBtn.closest('.acf-image-uploader');
				const input = uploader ? uploader.querySelector('input[type="hidden"]') : null;
				const img = uploader ? uploader.querySelector('img[data-name="image"]') : null;

				if (input) {
					input.value = '';
					if (window.jQuery) {
						window.jQuery(input).trigger('change');
					}
				}
				if (img) {
					img.src = '';
					img.style.display = 'none';
				}
				if (uploader) {
					uploader.classList.remove('has-value');
				}

				if (typeof window.acf !== 'undefined' && uploader) {
					const field = window.acf.getField(uploader.closest('.acf-field'));
					if (field) {
						field.val('');
					}
				}
			}
		},
		true
	);
};

document.readyState === 'loading' ? document.addEventListener('DOMContentLoaded', run, { once: true }) : run();
