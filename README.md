# 30days

### Video Demo

-   URL HERE

### Technologies used

-   HTML
-   CSS
-   BootStrap
-   Laravel
-   Mysql

## Description

このプロジェクトは、挑戦する 30 日間を共有する Web サイトです。このプロジェクトを通して、Laravel フレームワークやデータベースに関する知識を広げたいと思いました。

このプロジェクトの対象者は、新しいことに挑戦したい人や挑戦を継続したい人です。一歩を踏み出せない人、挑戦がなかなか継続できない人に、挑戦するきっかけと仲間を作る環境を提供します。その方法として、30 日間継続したいことを掲げ、毎日の振り返りします。途中、挑戦をやめたくなった時は、他のユーザーの挑戦を見ることができます。挑戦しているのが自分だけではないことが分かれば、自分ももう少し頑張ってみようと思うことができます。

This project is a website that shares 30 days of challenges. I wanted to expand my knowledge of the Laravel framework and database through this project.

The target audience for this project is people who want to try new things and keep trying. For those who are unable to take the first step or continue their challenge, we will provide them with an opportunity to challenge themselves and make friends. As a way to do this, we set a goal that we want to continue for 30 days and reflect on it every day. If you feel like quitting the challenge, you can watch other users' challenges. When you see that you are not alone in your challenge, you will be inspired to try a little harder.

### How to use

まず、ヘッダーにある新規登録画面に移動し、登録をしてください。登録後はダッシュボード画面に移動します。ダッシュボード画面では、30 日間の挑戦を設定することができます。挑戦を設定すると１日の振り返りを登録することができるようになります。誤った入力をした場合は編集画面に移動し内容を修正することができます。また、他の人の挑戦を見たい時はヘッダーにある Other Challenge リンクから他の人の挑戦を見ることができます。

First, go to the New Registration screen in the header and register. After registering, you will be taken to the dashboard screen. In the dashboard screen, you can set up a 30-day challenge. Once you set the challenge, you will be able to register a daily recap. If you make a mistake, you can go to the edit screen to correct the content. Also, if you want to see other people's challenges, you can click the Other Challenge link in the header to see other people's challenges.

### ルーティング

個人のダッシュボードを起点として、プロフィールの変更、挑戦の設定、挑戦に対する振り返りの画面に遷移する設定をしています。

Starting from your personal dashboard, you can change your profile, set up challenges, and reflect on your challenges.

### バリデーション

それぞれの入力フォームで必須や文字の制限を行うなどのバリデーションの設定をしています。

Each input form has its own validation settings such as required and character restrictions.

### コントローラー

フォームから送られてきたデータの登録・更新や遷移するページを選択する設定をしています。

The settings are used to register and update data sent from the form and to select the page to transition to.

### データベース

テーブルは users テーブル、challenges テーブル、diaries テーブル の３つがあります。users テーブルと challenges テーブル は一対多の関係です。challenges テーブルと diaries テーブルも一対多の関係です。

There are three tables: users table, challenges table, and diaries table. users table has a one-to-many relationship with challenges table. challenges table has a one-to-many relationship with diaries table.
