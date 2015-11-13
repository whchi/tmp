這個API只是拿來練習RESTful的設計，使用方式寫在各ws裡面
###設計概念
只透過`POST`來執行，因此相對應的文件需要很明確指出用法

* #####WS路徑
`http://hostname/{module}/{action}`，翻譯成此程式碼就是`http://hostname/articles/add_an_instance`

* #####API設計概念
大致上分為3層(可用MVC的觀念來看)

1. **[view]**最外層的接收端，只進行接收與回傳json
2. **[controller]**檢查傳入變數是否有問題，並處理回傳訊息
	* 參數錯誤的訊息在這層處理
3. **[model]**執行對應的WS動作(實際呼叫DB連線的class，只處理對資料庫的CRUD並回傳結果)
	* 資料庫連線錯誤的訊息在這層處理

---
備註:

* 與DB連線那段是用PDO實作，如果沒有PDO模組請安裝
* 兩份sql檔案都要安裝，因為有綁定外部索引
* db_lib中有debuglog這段尚未實作