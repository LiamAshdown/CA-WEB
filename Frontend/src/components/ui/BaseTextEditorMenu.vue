<template>
  <div class="d-flex justify-content-between">
    <template v-for="(item, index) in items">
      <base-text-editor-item :key="index" v-bind="item" />
    </template>
  </div>
</template>

<script>
import BaseTextEditorItem from './BaseTextEditorItem.vue'

export default {
  components: {
    BaseTextEditorItem
  },

  props: {
    editor: {
      type: Object,
      required: true
    }
  },

  data () {
    return {
      items: [
        {
          icon: 'bold',
          title: 'Bold',
          action: () => this.editor.chain().focus().toggleBold().run(),
          isActive: () => this.editor.isActive('bold')
        },
        {
          icon: 'italic',
          title: 'Italic',
          action: () => this.editor.chain().focus().toggleItalic().run(),
          isActive: () => this.editor.isActive('italic')
        },
        {
          icon: 'strikethrough',
          title: 'Strike',
          action: () => this.editor.chain().focus().toggleStrike().run(),
          isActive: () => this.editor.isActive('strike')
        },
        {
          icon: 'H1',
          title: 'Heading 1',
          action: () => this.editor.chain().focus().toggleHeading({ level: 1 }).run(),
          isActive: () => this.editor.isActive('heading', { level: 1 })
        },
        {
          icon: 'H2',
          title: 'Heading 2',
          action: () => this.editor.chain().focus().toggleHeading({ level: 2 }).run(),
          isActive: () => this.editor.isActive('heading', { level: 2 })
        },
        {
          icon: 'paragraph',
          title: 'Paragraph',
          action: () => this.editor.chain().focus().setParagraph().run(),
          isActive: () => this.editor.isActive('paragraph')
        },
        {
          icon: 'list-ul',
          title: 'Bullet List',
          action: () => this.editor.chain().focus().toggleBulletList().run(),
          isActive: () => this.editor.isActive('bulletList')
        },
        {
          icon: 'list-ol',
          title: 'Ordered List',
          action: () => this.editor.chain().focus().toggleOrderedList().run(),
          isActive: () => this.editor.isActive('orderedList')
        },
        {
          icon: 'code',
          title: 'Code Block',
          action: () => this.editor.chain().focus().toggleCodeBlock().run(),
          isActive: () => this.editor.isActive('codeBlock')
        },
        {
          icon: 'quote-right',
          title: 'Blockquote',
          action: () => this.editor.chain().focus().toggleBlockquote().run(),
          isActive: () => this.editor.isActive('blockquote')
        },
        {
          icon: 'undo',
          title: 'Undo',
          action: () => this.editor.chain().focus().undo().run()
        },
        {
          icon: 'redo',
          title: 'Redo',
          action: () => this.editor.chain().focus().redo().run()
        }
      ]
    }
  }
}
</script>
