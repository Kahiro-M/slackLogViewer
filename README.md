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

