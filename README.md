# Slack Log Viewer
Slackからエクスポートした会話データを閲覧するビューアーです。

## How To Use?
 1. Slackから会話データをエクスポートする。  
    - 利用ツール：[SlackExportTool](https://github.com/Kahiro-M/slackExportTool/releases/tag/v.1.0.1)  
        `slackExport --token xoxp-XXXXXXXXXXXXX-XXXXXXXXXXXXX-XXXXXXXXXXXXX-XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX --output-dir /output/dir/path`
    - 標準機能：[ワークスペースのデータをエクスポートする](https://slack.com/intl/ja-jp/help/articles/201658943)  
        標準機能でダウンロード場合はZIP形式に圧縮する。
 2. [slackJsonToCsv](https://github.com/Kahiro-M/slackJsonToCsv/releases/tag/v.1.0.7)でエクスポートしたデータをSQLiteファイルに変換する。  
    `json2csv4slack OUTPUT_JSON.zip other sqlite`
 3. [slackLogViewer](https://github.com/Kahiro-M/slackLogViewer)をWEBサーバのドキュメントルートにアップロードする。
 4. WEBサーバ内にDBファイル保管ディレクトリを作成し、SQLiteファイルをアップロードする。  
    ※DBファイル保管ディレクトリはHTTPでアクセスできない場所にする。
 5. `config/env.php.sample`を元に`config/env.php`を作成する。  
    ※`$dbFilePath`と`$defaultChannelCode`は利用する環境に合わせて設定する。
 6. `https://WEBサーバのURL/viewer_channel.php`にアクセスする。

## TIPS
- 本家Slackと同じユーザアイコンを使用する場合は`img/user_icon/[users.jsonの"id"].jpg`を配置する。  
    - 利用ツール：[getSlackUsersIcon](https://github.com/Kahiro-M/getSlackUsersIcon/releases/tag/v.1.0.1)  
    `getUsersIcon xoxp-XXXXXXXXXXXXX-XXXXXXXXXXXXX-XXXXXXXXXXXXX-XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX`
    - 例) 
      ```
         document_root
            └- img
               └- user_icon
                  ├- /U06UA6TBJ2C.jpg
                  ├- /U06SUUX9UU8.jpg
                  └- /U06S8KEN95L.jpg
      ```

- メッセージの添付ファイルを使用する場合は`[添付ファイルを保存するディレクトリのパス]/[msgid]_[ファイル名].[拡張子]`を配置する。  
   - 利用ツール：[getSlackAttachmentFiles](https://github.com/Kahiro-M/getSlackAttachmentFiles/releases)  
    `getSlackAttachmentFiles xoxp-XXXXXXXXXXXXX-XXXXXXXXXXXXX-XXXXXXXXXXXXX-XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX`
   - `config/env.php.sample`を元に`config/env.php`を作成する。  
      ```php
         <?php
         ...(略)...
         // 添付ファイルを保存するディレクトリのパス（ドキュメントルートから見た相対パス）
         $filesDirPath = 'files';
         ...(略)...
         ?>
      ```
   - 例) 
      ```
         document_root
            └- files
               ├- fcd7ae2e-b469-5784-99c9-92c2ab866175_image.png
               ├- c1c611b2-6c20-5d36-9cf4-151530d9e65e_IMG_0001.jpeg
               └- 8816fe88-63e8-5c48-92d4-05bbd5a1fec3_sample.docx
      ```
