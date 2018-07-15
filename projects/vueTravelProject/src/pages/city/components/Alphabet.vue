<template>
	<ul class="list">
		<li class="item" :href="'#'+item"
		 	v-for="item in letters"
		 	:key="item"
		 	:ref="item"
		 	@click="handleLetterClick"
		 	@touchstart="handleTouchStart"
		 	@touchmove="handleTouchMove"
		 	@touchend="handleTouchEnd"
		 	>
			{{item}}
		</li>
	</ul>
</template>
<script>
	export default {
		name: 'CityAlphabet',
		props:{
			city: Object
		},
		data () {
			return {
				touchStatus: false,
				startY: 0
			}
		},
		computed:{
			letters () {
				const letters = []
				for (let i in this.city) {
					letters.push(i)
				}
				return letters
			}
		},
		updated () {
			this.startY = this.$refs['A'][0].offsetTop
		},
		methods:{
			handleLetterClick (e) {
				this.$emit('change', e.target.innerText)
			},
			handleTouchStart () {
				this.touchStatus = true
			},
			handleTouchMove (e) {
				if (this.touchStatus) {
					if (this.timer) {
						clearTimeout(this.timer)
					}
					this.timer = setTimeout(() => {
						const touchY = e.touches[0].clientY - 75
						const index = Math.floor(touchY - this.startY) / 20
						if (index >= 0 && index < this.letters.length) {
							this.$emit('change', this.letters[index])	
						}
					}, 16)	
				}
			},
			handleTouchEnd () {
				this.touchStatus = false
			}
		}
}
	
</script>
<style lang="stylus" scoped>
@import '~styles/varibles.styl'
	.list
		display:flex
		flex-direction:column
		justify-content:center
		position:absolute
		top:1.58rem
		right:0
		bottom:0
		width:.4rem
		.item
			text-align:center
			line-height:.4rem
			color:$bgColor
</style>