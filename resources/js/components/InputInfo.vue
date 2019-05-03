<template>
	<div class="input-info">
		<p class="input-info-text mb-2">{{ messages['recipients-input-info-total'] + ' ' + recipients.length }}</p>
		<details>
			<summary><span>{{ messages['recipients-input-info-show']  }}</span></summary>
			<div>
				<p class="input-info-recipients-title">{{ messages['recipients-header'] }}</p>
				<ul class="input-info-recipients-list">
					<li v-for="recipient in recipients">
						{{ recipient.name }} - <span class="email-text">{{ recipient.email }}</span>
					</li>
				</ul>
			</div>
		</details>
	</div>
</template>
<script>
	export default {
		name: 'input-info',
		props: ['messages', 'recipients'],
		mounted() {
			console.log('hola');
		}
	}
</script>
<style lang="scss">
	.input-info {

		&-text {
			font-style: italic;
		}

		&-recipients {
			&-title {
				font-size: 25px;
				font-weight: bold;
				margin-bottom: 20px;
			}

			&-list {
				list-style-type: none;
				padding: 0;

				li {
					font-size: 15px;

					&:not(:last-child) {
						margin-bottom: 10px;
					}

					.email-text {
						color: var(--primary);
						font-style: italic;
					}
				}
			}
		}

		details summary {
			color: var(--primary);
			overflow: hidden;
			font-style: italic;
			font-weight: bold;
			outline: none;
			text-decoration: underline;

			span {
				cursor: pointer;

				&:active,
				&:focus,
				&:hover {
					text-decoration: underline;
				}
			}

		}

		details[open] > summary::before {
			background: rgba(27,31,35,0.5);
			bottom: 0;
			content: " ";
			cursor: default;
			display: block;
			left: 0;
			position: fixed;
			right: 0;
			top: 0;
			z-index: 99;
		}

		details > div {
			animation-name: fadein;
			animation-duration: 300ms;
			animation-timing-function: ease-in-out;
			background-color: #FFFFFF;
			border-radius: 3px;
			border: 1px solid transparent;
			border-top: 4px solid var(--primary);
			box-shadow: 1px 1px 10px rgba(0,0,0,0.3);
			left: 50%;
			margin: 10vh auto;
			max-height: 80vh;
			max-width: 90vw;
			overflow: auto;
			padding: 3em 1em;
			position: fixed;
			top: 0;
			transform: translateX(-50%);
			width: 448px;
			z-index: 999;
		}

		@keyframes fadein {
			from { opacity: 0; }
			to   { opacity: 1; }
		}

		details summary::-webkit-details-marker {
			display:none;
		}
	}
</style>