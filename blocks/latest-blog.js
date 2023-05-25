wp.blocks.registerBlockType("blockville/latest-blog", {
  title: "Latest Blog",
  edit: function () {
    return wp.element.createElement(
      "div",
      { className: "latest-blog" },
      "Latest Blog"
    );
  },
  save: function () {
    return null;
    //returns null because I want 100% php processesing
  },
});
