# Bot By Diegoツ 22 Januari 2023
## Last Update Offset : 22 Agustus 2024

# **Instruction How To Update Offset & Setup BE :**
─── You Can Find Address On This List With **Base Address be in spesifc range**, Get Value *From*, on `getAddress('Client.Exe')` & Get Value *To*, from `getModuleSize('Client.Exe')`.
─── **Copy Paste this function and Find & Replace ([A-Za-z0-9]+(,[A-Za-z0-9]+)+) to fast remove offset**

### `Offset Player`    
────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────<br>   
   ___   __  __          _     ____  _                         
  / _ \ / _|/ _|___  ___| |_  |  _ \| | __ _ _   _  ___ _ __   
 | | | | |_| |_/ __|/ _ \ __| | |_) | |/ _` | | | |/ _ \ '__|  
 | |_| |  _|  _\__ \  __/ |_  |  __/| | (_| | |_| |  __/ |     
  \___/|_| |_| |___/\___|\__| |_|   |_|\__,_|\__, |\___|_|     
                                             |___/                        
────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────<br>   
Offset Changed : 
2F90
────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────<br>  
:IDPlayer:		                           51A8E8   [StaticAddress] | `Different Offset`      
:TargetID:                                51B670   [StaticAddress] | `Different Offset`  
:SignChat0CanMoveOrChatDeadactive:        4F11DC   [StaticAddress] | `Different Offset` 
:SignChat0TyperDeadactive:                4EF6E4,14,0,0,4,14,20       
:SignTradeRequest:                        4F2934   [StaticAddress] | `Different Offset` `For Auto Get Buff Rune Master`      
:xFirstCharacterButtonOnSelectCharacter:                    4EF6DC,14,C,1A0,C,20,F4               [1426]`Find With Value On Login Screen`
:yFirstCharacterButtonOnSelectCharacter:                    4EF6DC,14,C,1A0,C,20,F8    
:SignLobbyIndicatorFirstCharacterButtonOnSelectCharacter:   4EF6DC,14,C,10   
────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────<br>  


────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────<br>  
:Name:		                   515CC0,179               
:HP:		                      515CC0,410                
:HPMaks:	                      515CC0,414               
:MP:		                      515CC0,9CC              
:MPMaks:		                   515CC0,9D0               
:CurrentGold:	                515CC0,9E8	             
:xPosition:	                   515CC0,1A1                      
:yPosition:	                   515CC0,1A9	     
:RunStatus:                    515CC0,260            [0/256]`NotRun`
:CodeAction:                   515CC0,19F            [2]`Run | Search By NickName 0 MemoryView 0 find 02 at run`
:BattleState:                  515CC0,2C0            [0]`CanChangeMap`          
:MoveSpeed:                    515CC0,C4C                      
─────────────────────────────────────────────        
:CurrentCodeMapPlayer:		    54DB2C                [200] `Lobby | Gate Alker = 19 , Zakan 22 , NH 55`   
────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────<br>  
:CurrentLevelCharacter:         51235C,1A0,14,1F8   [TEXT]
:Channel:                       5172F0
:CameraZoom:                    BC3B0,34           [34]`LastOffset` | `Different Offset`                  
:XCamera:                       BC3B0,24           [24]`LastOffset` | `Different Offset`                
:YCamera:                       BC3B0,14           [14]`LastOffset` | `Different Offset`                
:xPointCamera:                  BC3B0,38           [38]`LastOffset` | `Different Offset`    
:zPointCamera:                  BC3B0,3C           [3c]`LastOffset` | `Different Offset`       
:yPointCamera:                  BC3B0,40           [40]`LastOffset` | `Different Offset`   
────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────<br>  
:TargetName:                    5123E4,26C,1F8        
:xTabMonster:                   5123E4,F4         
:yTabMonster:                   5123E4,F8
────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────<br>  
:xReviveHereButton:             5123D8,1B8,F4             
:yReviveHereButton:             5123D8,1B8,F8              
:SignDeath:                     5123D8,10                   
────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────<br>  
:xMap:                          5123C0,F4                  
:yMap:                          5123C0,F8     
:SignMapOpen:                   5123C0,10    
:CountPartyMember:              5123C0,284         `Default 6 Non Have Party / Non Have Member`            
────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────<br> 
:SignWorld0CantMove:                    51A370                   
:LastChat:                              512494,1B8,1C8,8,C  
────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────<br>  
:xInventory:                            5122E8,F4
:yInventory:                            5122E8,F8
:SignInventoryOpen:                     5122E8,10
:SlotBagID:                             5122E8,1B8
:SignLastBagSlot:                       5122E8,1C0,C,1C0,9C                           [ForExtraFeature]     
────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────<br> 
:xMoveButtonOnChangeMap:                512508,1D8,F4
:yMoveButtonOnChangeMap:                512508,1D8,F8
:IDChangeMapSelection:                  512508,1E4                       
:SignUseItemChangeMap:                  512508,10                        
────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────<br>   
:xSelectCharacterButtonOnMenuExit:      51231C,E4,EC,8,8,F4                       
:ySelectCharacterButtonOnMenuExit:      51231C,E4,EC,8,8,F8       
:SignMenuExit:                          51231C,10                             
────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────<br>
:SignAFK:                               5125D4,10 
:xAFKHeader:                            5125D4,F4 
:yAFKHeader:                            5125D4,F8 
────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────<br> :SignRidingMount:                       5122E8,1D8,1BC,230,1C4           
────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────<br>
:xPartyInvite:                          512394,F4 
:yPartyInvite:                          512394,F8 
:SignPartyRequest:                      512394,10 
────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────<br> 
:xPartyInviteWindow:                    512594,F4 
:yPartyInviteWindow:                    512594,F8 
:SignPartyInviteWindow:                 512594,10 
────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────<br> 


### `Offset Auto Login`    
────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────<br>   
   ___   __  __          _        _         _          _                _       
  / _ \ / _|/ _|___  ___| |_     / \  _   _| |_ ___   | |    ___   __ _(_)_ __  
 | | | | |_| |_/ __|/ _ \ __|   / _ \| | | | __/ _ \  | |   / _ \ / _` | | '_ \ 
 | |_| |  _|  _\__ \  __/ |_   / ___ \ |_| | || (_) | | |__| (_) | (_| | | | | |
  \___/|_| |_| |___/\___|\__| /_/   \_\__,_|\__\___/  |_____\___/ \__, |_|_| |_|
                                                                  |___/                        
────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────<br>   
:xConnectButtonOnSelectServer:                              511E68,E4,100,F4   [13]left
:yConnectButtonOnSelectServer:                              511E68,E4,100,F8                 
:SignConnectButtonOnSelectServer:                           511E68,10     
:xLoginForm:                                                54FBB8,2C,4,1B0,C,F4   
:yLoginForm:                                                54FBB8,2C,4,1B0,C,F8  
:SignLoginForm:                                             54FBB8,2C,4,10   
:xConnectButtonOnSelectChannel:                             51206C,1A4,4,8,F4
:yConnectButtonOnSelectChannel:                             51206C,1A4,4,8,F8
:SignConnectButtonOnSelectChannel:                          51206C,10       
:CountCharacter:                                            51A9A4           [StaticValue]      
────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────<br>  

# Inventory Offset
────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────<br>  
//────────────────────────── SignItemBag1──────────────────────────────<br>  
:SignItemBag1Slot1:                                5122E8,1C0,0,1C0,4
:SignItemBag1Slot2:                                5122E8,1C0,0,1C0,C
:SignItemBag1Slot3:                                5122E8,1C0,0,1C0,14
:SignItemBag1Slot4:                                5122E8,1C0,0,1C0,1C
:SignItemBag1Slot5:                                5122E8,1C0,0,1C0,24
:SignItemBag1Slot6:                                5122E8,1C0,0,1C0,2C
:SignItemBag1Slot7:                                5122E8,1C0,0,1C0,34
:SignItemBag1Slot8:                                5122E8,1C0,0,1C0,3C
:SignItemBag1Slot9:                                5122E8,1C0,0,1C0,44
:SignItemBag1Slot10:                               5122E8,1C0,0,1C0,4C
:SignItemBag1Slot11:                               5122E8,1C0,0,1C0,54
:SignItemBag1Slot12:                               5122E8,1C0,0,1C0,5C
:SignItemBag1Slot13:                               5122E8,1C0,0,1C0,64
:SignItemBag1Slot14:                               5122E8,1C0,0,1C0,6C
:SignItemBag1Slot15:                               5122E8,1C0,0,1C0,74
:SignItemBag1Slot16:                               5122E8,1C0,0,1C0,7C
:SignItemBag1Slot17:                               5122E8,1C0,0,1C0,84
:SignItemBag1Slot18:                               5122E8,1C0,0,1C0,8C
:SignItemBag1Slot19:                               5122E8,1C0,0,1C0,94
:SignItemBag1Slot20:                               5122E8,1C0,0,1C0,9C
────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────<br>  
//────────────────────────── ItemNameBag1 ──────────────────────────────<br>  
:ItemNameBag1Slot1:                                5122E8,1C0,0,1C0,0,54,4
:ItemNameBag1Slot2:                                5122E8,1C0,0,1C0,8,54,4
:ItemNameBag1Slot3:                                5122E8,1C0,0,1C0,10,54,4
:ItemNameBag1Slot4:                                5122E8,1C0,0,1C0,18,54,4
:ItemNameBag1Slot5:                                5122E8,1C0,0,1C0,20,54,4
:ItemNameBag1Slot6:                                5122E8,1C0,0,1C0,28,54,4
:ItemNameBag1Slot7:                                5122E8,1C0,0,1C0,30,54,4
:ItemNameBag1Slot8:                                5122E8,1C0,0,1C0,38,54,4
:ItemNameBag1Slot9:                                5122E8,1C0,0,1C0,40,54,4
:ItemNameBag1Slot10:                               5122E8,1C0,0,1C0,48,54,4
:ItemNameBag1Slot11:                               5122E8,1C0,0,1C0,50,54,4
:ItemNameBag1Slot12:                               5122E8,1C0,0,1C0,58,54,4
:ItemNameBag1Slot13:                               5122E8,1C0,0,1C0,60,54,4
:ItemNameBag1Slot14:                               5122E8,1C0,0,1C0,68,54,4
:ItemNameBag1Slot15:                               5122E8,1C0,0,1C0,70,54,4
:ItemNameBag1Slot16:                               5122E8,1C0,0,1C0,78,54,4
:ItemNameBag1Slot17:                               5122E8,1C0,0,1C0,80,54,4
:ItemNameBag1Slot18:                               5122E8,1C0,0,1C0,88,54,4
:ItemNameBag1Slot19:                               5122E8,1C0,0,1C0,90,54,4
:ItemNameBag1Slot20:                               5122E8,1C0,0,1C0,98,54,4
────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────<br>  
//────────────────────────── SignItemBag2 ──────────────────────────────<br>  
:SignItemBag2Slot1:                                5122E8,1C0,4,1C0,4
:SignItemBag2Slot2:                                5122E8,1C0,4,1C0,C
:SignItemBag2Slot3:                                5122E8,1C0,4,1C0,14
:SignItemBag2Slot4:                                5122E8,1C0,4,1C0,1C
:SignItemBag2Slot5:                                5122E8,1C0,4,1C0,24
:SignItemBag2Slot6:                                5122E8,1C0,4,1C0,2C
:SignItemBag2Slot7:                                5122E8,1C0,4,1C0,34
:SignItemBag2Slot8:                                5122E8,1C0,4,1C0,3C
:SignItemBag2Slot9:                                5122E8,1C0,4,1C0,44
:SignItemBag2Slot10:                               5122E8,1C0,4,1C0,4C
:SignItemBag2Slot11:                               5122E8,1C0,4,1C0,54
:SignItemBag2Slot12:                               5122E8,1C0,4,1C0,5C
:SignItemBag2Slot13:                               5122E8,1C0,4,1C0,64
:SignItemBag2Slot14:                               5122E8,1C0,4,1C0,6C
:SignItemBag2Slot15:                               5122E8,1C0,4,1C0,74
:SignItemBag2Slot16:                               5122E8,1C0,4,1C0,7C
:SignItemBag2Slot17:                               5122E8,1C0,4,1C0,84
:SignItemBag2Slot18:                               5122E8,1C0,4,1C0,8C
:SignItemBag2Slot19:                               5122E8,1C0,4,1C0,94
:SignItemBag2Slot20:                               5122E8,1C0,4,1C0,9C
────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────<br>  
//────────────────────────── ItemNameBag2 ──────────────────────────────<br>  
:ItemNameBag2Slot1:                                5122E8,1C0,4,1C0,0,54,4
:ItemNameBag2Slot2:                                5122E8,1C0,4,1C0,8,54,4
:ItemNameBag2Slot3:                                5122E8,1C0,4,1C0,10,54,4
:ItemNameBag2Slot4:                                5122E8,1C0,4,1C0,18,54,4
:ItemNameBag2Slot5:                                5122E8,1C0,4,1C0,20,54,4
:ItemNameBag2Slot6:                                5122E8,1C0,4,1C0,28,54,4
:ItemNameBag2Slot7:                                5122E8,1C0,4,1C0,30,54,4
:ItemNameBag2Slot8:                                5122E8,1C0,4,1C0,38,54,4
:ItemNameBag2Slot9:                                5122E8,1C0,4,1C0,40,54,4
:ItemNameBag2Slot10:                               5122E8,1C0,4,1C0,48,54,4
:ItemNameBag2Slot11:                               5122E8,1C0,4,1C0,50,54,4
:ItemNameBag2Slot12:                               5122E8,1C0,4,1C0,58,54,4
:ItemNameBag2Slot13:                               5122E8,1C0,4,1C0,60,54,4
:ItemNameBag2Slot14:                               5122E8,1C0,4,1C0,68,54,4
:ItemNameBag2Slot15:                               5122E8,1C0,4,1C0,70,54,4
:ItemNameBag2Slot16:                               5122E8,1C0,4,1C0,78,54,4
:ItemNameBag2Slot17:                               5122E8,1C0,4,1C0,80,54,4
:ItemNameBag2Slot18:                               5122E8,1C0,4,1C0,88,54,4
:ItemNameBag2Slot19:                               5122E8,1C0,4,1C0,90,54,4
:ItemNameBag2Slot20:                               5122E8,1C0,4,1C0,98,54,4

────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────<br>  
//────────────────────────── SignItemBag3 ──────────────────────────────<br>  
:SignItemBag3Slot1:                                5122E8,1C0,8,1C0,4
:SignItemBag3Slot2:                                5122E8,1C0,8,1C0,C
:SignItemBag3Slot3:                                5122E8,1C0,8,1C0,14
:SignItemBag3Slot4:                                5122E8,1C0,8,1C0,1C
:SignItemBag3Slot5:                                5122E8,1C0,8,1C0,24
:SignItemBag3Slot6:                                5122E8,1C0,8,1C0,2C
:SignItemBag3Slot7:                                5122E8,1C0,8,1C0,34
:SignItemBag3Slot8:                                5122E8,1C0,8,1C0,3C
:SignItemBag3Slot9:                                5122E8,1C0,8,1C0,44
:SignItemBag3Slot10:                               5122E8,1C0,8,1C0,4C
:SignItemBag3Slot11:                               5122E8,1C0,8,1C0,54
:SignItemBag3Slot12:                               5122E8,1C0,8,1C0,5C
:SignItemBag3Slot13:                               5122E8,1C0,8,1C0,64
:SignItemBag3Slot14:                               5122E8,1C0,8,1C0,6C
:SignItemBag3Slot15:                               5122E8,1C0,8,1C0,74
:SignItemBag3Slot16:                               5122E8,1C0,8,1C0,7C
:SignItemBag3Slot17:                               5122E8,1C0,8,1C0,84
:SignItemBag3Slot18:                               5122E8,1C0,8,1C0,8C
:SignItemBag3Slot19:                               5122E8,1C0,8,1C0,94
:SignItemBag3Slot20:                               5122E8,1C0,8,1C0,9C
────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────<br>  
//────────────────────────── ItemNameBag3 ──────────────────────────────<br>  
:ItemNameBag3Slot1:                                5122E8,1C0,8,1C0,0,54,4
:ItemNameBag3Slot2:                                5122E8,1C0,8,1C0,8,54,4
:ItemNameBag3Slot3:                                5122E8,1C0,8,1C0,10,54,4
:ItemNameBag3Slot4:                                5122E8,1C0,8,1C0,18,54,4
:ItemNameBag3Slot5:                                5122E8,1C0,8,1C0,20,54,4
:ItemNameBag3Slot6:                                5122E8,1C0,8,1C0,28,54,4
:ItemNameBag3Slot7:                                5122E8,1C0,8,1C0,30,54,4
:ItemNameBag3Slot8:                                5122E8,1C0,8,1C0,38,54,4
:ItemNameBag3Slot9:                                5122E8,1C0,8,1C0,40,54,4
:ItemNameBag3Slot10:                               5122E8,1C0,8,1C0,48,54,4
:ItemNameBag3Slot11:                               5122E8,1C0,8,1C0,50,54,4
:ItemNameBag3Slot12:                               5122E8,1C0,8,1C0,58,54,4
:ItemNameBag3Slot13:                               5122E8,1C0,8,1C0,60,54,4
:ItemNameBag3Slot14:                               5122E8,1C0,8,1C0,68,54,4
:ItemNameBag3Slot15:                               5122E8,1C0,8,1C0,70,54,4
:ItemNameBag3Slot16:                               5122E8,1C0,8,1C0,78,54,4
:ItemNameBag3Slot17:                               5122E8,1C0,8,1C0,80,54,4
:ItemNameBag3Slot18:                               5122E8,1C0,8,1C0,88,54,4
:ItemNameBag3Slot19:                               5122E8,1C0,8,1C0,90,54,4
:ItemNameBag3Slot20:                               5122E8,1C0,8,1C0,98,54,4────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────<br>  
//────────────────────────── SignItemBag4 ──────────────────────────────<br>  
:SignItemBag4Slot1:                                5122E8,1C0,C,1C0,4
:SignItemBag4Slot2:                                5122E8,1C0,C,1C0,C
:SignItemBag4Slot3:                                5122E8,1C0,C,1C0,14
:SignItemBag4Slot4:                                5122E8,1C0,C,1C0,1C
:SignItemBag4Slot5:                                5122E8,1C0,C,1C0,24
:SignItemBag4Slot6:                                5122E8,1C0,C,1C0,2C
:SignItemBag4Slot7:                                5122E8,1C0,C,1C0,34
:SignItemBag4Slot8:                                5122E8,1C0,C,1C0,3C
:SignItemBag4Slot9:                                5122E8,1C0,C,1C0,44
:SignItemBag4Slot10:                               5122E8,1C0,C,1C0,4C
:SignItemBag4Slot11:                               5122E8,1C0,C,1C0,54
:SignItemBag4Slot12:                               5122E8,1C0,C,1C0,5C
:SignItemBag4Slot13:                               5122E8,1C0,C,1C0,64
:SignItemBag4Slot14:                               5122E8,1C0,C,1C0,6C
:SignItemBag4Slot15:                               5122E8,1C0,C,1C0,74
:SignItemBag4Slot16:                               5122E8,1C0,C,1C0,7C
:SignItemBag4Slot17:                               5122E8,1C0,C,1C0,84
:SignItemBag4Slot18:                               5122E8,1C0,C,1C0,8C
:SignItemBag4Slot19:                               5122E8,1C0,C,1C0,94
:SignItemBag4Slot20:                               5122E8,1C0,C,1C0,9C────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────<br>  
//────────────────────────── ItemNameBag4 ──────────────────────────────<br>  
:ItemNameBag4Slot1:                                5122E8,1C0,C,1C0,0,54,4
:ItemNameBag4Slot2:                                5122E8,1C0,C,1C0,8,54,4
:ItemNameBag4Slot3:                                5122E8,1C0,C,1C0,10,54,4
:ItemNameBag4Slot4:                                5122E8,1C0,C,1C0,18,54,4
:ItemNameBag4Slot5:                                5122E8,1C0,C,1C0,20,54,4
:ItemNameBag4Slot6:                                5122E8,1C0,C,1C0,28,54,4
:ItemNameBag4Slot7:                                5122E8,1C0,C,1C0,30,54,4
:ItemNameBag4Slot8:                                5122E8,1C0,C,1C0,38,54,4
:ItemNameBag4Slot9:                                5122E8,1C0,C,1C0,40,54,4
:ItemNameBag4Slot10:                               5122E8,1C0,C,1C0,48,54,4
:ItemNameBag4Slot11:                               5122E8,1C0,C,1C0,50,54,4
:ItemNameBag4Slot12:                               5122E8,1C0,C,1C0,58,54,4
:ItemNameBag4Slot13:                               5122E8,1C0,C,1C0,60,54,4
:ItemNameBag4Slot14:                               5122E8,1C0,C,1C0,68,54,4
:ItemNameBag4Slot15:                               5122E8,1C0,C,1C0,70,54,4
:ItemNameBag4Slot16:                               5122E8,1C0,C,1C0,78,54,4
:ItemNameBag4Slot17:                               5122E8,1C0,C,1C0,80,54,4
:ItemNameBag4Slot18:                               5122E8,1C0,C,1C0,88,54,4
:ItemNameBag4Slot19:                               5122E8,1C0,C,1C0,90,54,4
:ItemNameBag4Slot20:                               5122E8,1C0,C,1C0,98,54,4────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────<br



# Other Luna
──────────────────────────────────────────────────────────────────────────────────────────────────────────────────────<br>   
:xBorderSkull:                      0                // `10 left = SCAN WITH VALUE, DONT WITH ADDRESS = SAFE LAST OFFSET IS 0`  
:yBorderSkull:                      0
:xBorderBossSkull:                  0                //`17 left = SCAN WITH VALUE, DONT WITH ADDRESS = SAFE LAST OFFSET IS 0`  
:yBorderBossSkull:                  0
─────────────For Macro Detect GM───────────────────────────────────────────────────────────────────────────────────────<br>   
:LastSeenNickName:                  51A3F0,8,0,7C,370,180,2C    
:LastSeenID:                        54B8F8,4,8,4,420     
───────────────────────────────────────────────────────────────────────────────────────────────────────────────────────<br>
:SignDC:                            0     `use Network`
:DeleteCharacterAnswer:             0                **Value answer autospamrune**      
:MessageErrorCreateCharacter:       0                **Value answer autospamrune**
───────────────────────────────────────────────────────────────────────────────────────────────────────────────────────<br
:CodeNPCTrading:                    0  `CE 2 bytes` **[57] Drocus ( Zakandia ) | [40] Namorika ( MBP ) | [0] NOT NPC TALK | [649]**
:SignShopNPC:                       0                        
:TextSellItem:                      0           
:SignTextSellItem:                  0                       
────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────<br>  
:xCloseTradeButton:                 0 
:yCloseTradeButton:                 0 
:SignCloseTradeButton:              0 
────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────<br>  
:SignBankStorage:		               0   
:xBankStorage:		                  0 
:yBankStorage:		                  0   
────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────<br>   
:xPanelInfoStatCharacter:           0 
:yPanelInfoStatCharacter:           0 
:SignPanelInfoStatCharacter:        0    
────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────<br>   
:SignNotification:                  0             
:xSignNotification:                 0          
:ySignNotification:                 0      
────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────<br> 
:SignMulaiButtonQuestNPC:		      0 
:xMulaiButtonQuestNPC:		         0      
:yMulaiButtonQuestNPC:		         0 
────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────<br> 
:xWindowSkill:                      0 
:yWindowSkill:                      0          
────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────<br> 
:NamePlayerCurrentTrade:            0                  // Name Of Current Trade
────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────<br> 
