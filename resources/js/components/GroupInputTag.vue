<template>
	<div class="group-input-tag">
		<multiselect v-model="groups" :options="groupOptions" :placeholder="placeholder" multiple label="name" track-by="users" class="mb-2" @input="$emit('update:groupRecipients', recipients)" :closeOnSelect="false" optionsLimit="10" :selectLabel="messages['recipients-select-text']" :deselectLabel="messages['recipients-remove-text']" :selectedLabel="messages['recipients-selected-text']">
		    <template slot="singleLabel" slot-scope="props">
		    	<span class="option__desc">
		    		<span class="option__title">{{ props.option.name }}</span>
		    	</span>
		    </template>
			<template slot="option" slot-scope="props">
				<div class="option__desc">
					<span class="option__title">{{ props.option.name }}</span> - <span class="option__small">{{ messages['recipients-group-input-total'] + ' ' + props.option.users.length }}</span>
				</div>
			</template>
			<span slot="noResult">{{ messages['recipients-no-result'] }}</span>
			<span slot="noOptions">{{ messages['recipients-no-options'] }}</span>
		</multiselect>
		<div class="group-input-tag-info-container" v-if="groups && recipients.length > 0">
			<p class="group-input-tag-info mb-2">{{ messages['recipients-group-input-total'] + ' ' + recipients.length }}</p>
			<details>
				<summary><span>{{ messages['recipients-group-input-show'] }}</span></summary>
				<div>
					<p class="group-input-tag-recipients-title">{{ messages['recipients-header'] }}</p>
					<ul class="group-input-tag-recipients-list">
						<li v-for="recipient in recipients">
							{{ recipient.name }} - <span class="email-text">{{ recipient.email }}</span>
						</li>
					</ul>
				</div>
			</details>
		</div>
	</div>
</template>
<script>
	import Multiselect from 'vue-multiselect'

	export default {
		name: 'group-input-tag',
		props: ['placeholder', 'groupOptions', 'messages'],
		components: {
			Multiselect
		},
		data: () => ({
			groups: null
		}),
		mounted() {
			this.groupOptions.reverse();
		},
		computed: {
			recipients() {
				let allUsers = []
				this.groups.forEach((group) => {
					group.users.forEach((user) => {
						if (!allUsers.includes(user)) {
							allUsers.push(user);
						}
					})
				})

				return allUsers
			}
		},
		methods: {
			getOptionName (option) {
				return option.name + ' - ' + this.messages['recipients-group-input-total'] + ' ' + option.users.length
			}
		}
	}
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<style lang="scss">
	.group-input-tag {
		&-info {
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