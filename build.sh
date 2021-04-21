#!/usr/bin/env bash

OUT_DIR_NAME='target'
ZIP_FILE_NAME="my_plugin"

echo "recreating target dir: ${OUT_DIR_NAME}"
rm -rf $OUT_DIR_NAME
mkdir -p $OUT_DIR_NAME

echo "copying all src files to: ${OUT_DIR_NAME}"
rsync -av --exclude='composer.json' ./src/. $OUT_DIR_NAME/
cd $OUT_DIR_NAME

echo "compressing to ${ZIP_FILE_NAME}"
zip -q -9 -r "$ZIP_FILE_NAME.zip" *
tar -czvf "$ZIP_FILE_NAME.tar.gz" *
mv "$ZIP_FILE_NAME.zip" ../
mv "$ZIP_FILE_NAME.tar.gz" ../
cd -

echo "cleaning up ${OUT_DIR_NAME}"
rm -rf $OUT_DIR_NAME
