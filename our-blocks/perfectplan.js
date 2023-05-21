import { InnerBlocks } from "@wordpress/block-editor";

wp.blocks.registerBlockType("ourblocktheme/perfectplan", {
  title: "Perfect Plan",
  supports: {
    align: ["full"],
  },
  attributes: {
    align: { type: "string", default: "full" },
  },
  edit: editComponent,
  save: saveComponent,
});

function editComponent() {
  return (
    <div style={{ backgroundColor: "red", padding: "50px" }}>
      <InnerBlocks />
    </div>
  );
}

function saveComponent() {
  return (
    <div style={{ backgroundColor: "red", padding: "50px" }}>
      <InnerBlocks.Content />
    </div>
  );
}
